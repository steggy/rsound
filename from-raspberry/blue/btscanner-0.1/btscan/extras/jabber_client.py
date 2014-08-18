"""
  First I am sorry I had to use twisted, but.. twisted is definitely the best 
  for this kind of thing:

  Quick and dirty - python hooks
    

  easy_install twisted
"""

from twisted.words.protocols.jabber import client, jid
from twisted.words.xish import domish, xmlstream
from twisted.internet import reactor
import logging
import simplejson
import random

logger = logging.getLogger('btscan.extras.jabber_client')



#
# globals -- damn this is ugly -- quick hacky code.
#
global _user, _pass,_xmlstream
_user = None
_pass = None
_xmlstream = None
_me = None

def _process(data):
  " takes data, sends it on the stream"
  presence = domish.Element(('jabber:client', 'presence'))
  presence.addElement('status').addContent('Online')
  presence.addElement('data').addContent(simplejson.dumps(data))
  _xmlstream.send(presence)
  logger.debug("Sent over Jabber: %s" % (presence.toXml() ) )
  reactor.iterate()
  
  
def get_callback(user, password, port=5222, server=None, extra = "%i" %(random.randint(0,1000)) ):
  global _user, _pass, _me
  
  _user = user
  _pass = password
  
  (u,host) = _user.split("@")
  
  _me = jid.JID("%s/BluetoothScanner%s" %(_user, extra) )
  factory = client.basicClientFactory(_me, _pass)

  factory.addBootstrap(xmlstream.STREAM_CONNECTED_EVENT, authd)
  factory.addBootstrap(client.BasicAuthenticator.AUTH_FAILED_EVENT, authfailedEvent)

  reactor.connectTCP(host, 5222, factory)
  # start it all
  reactor.run()
  return _process
  
def gotPresence(el):

    t = el.attributes['type']
    if t == 'subscribe':
    # Grant every subscription request
      xmlstream.send(domish.Element(('jabber:client', 'presence'), attribs={
      'from': _me.full() ,
      'to':el.attributes['from'],
      'type':'subscribed'
    }))



def authfailedEvent(xmlstream):
  print "auth failed"
  global reactor
  logger.error('Jabber Auth failed!')
  reactor.stop()

def authd(xmlstream):
  global _xmlstream 
  logger.debug("authenticated")
  _xmlstream = xmlstream
  presence = domish.Element(('jabber:client', 'presence'))
  presence.addElement('status').addContent('Online')
  xmlstream.send(presence)
  
  # add a callback for the messages -- need to handle subscribe
  xmlstream.addObserver('/presence', gotPresence)
  
  reactor.stop() # stop the reactor.. so we can use iterate instead.

if( __name__ =='__main__'):
  import sys
  get_callback("test@localhost", "pass")
