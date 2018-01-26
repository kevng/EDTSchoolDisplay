#!/usr/bin/env python
# coding: utf-8

import socket

hote = "localhost"
port = 8000
socket.connect((hote, port))
socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
print "Connection on {}".format(port) 
socket.send("1")	
socket.close()
print "Close"