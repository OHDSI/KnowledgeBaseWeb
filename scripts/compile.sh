#!/bin/sh
export PATH=$PATH:.
export CLASSPATH=%CLASSPATH%:.:./lib/mysql-connector-java-5.1.36-bin.jar
javac *.java
