#!/bin/bash
set -e
echo "[ ****************** ] Starting Endpoint of Application"

# X-Debug
if [ -v ${XDEBUG_INSTALL} ] ; then
        cat $XDEBUGINI_PATH
	    echo "[ ****************** ] Starting install of XDebug and dependencies."
	    echo "zend_extension="`find /usr/local/lib/php/extensions/ -iname 'xdebug.so'` > $XDEBUGINI_PATH
	    echo "xdebug.remote_enable=$XDEBUG_REMOTE_ENABLE" >> $XDEBUGINI_PATH

	    if ! [ -v $XDEBUG_REMOTE_AUTOSTART ] ; then
	        echo "xdebug.remote_autostart=$XDEBUG_REMOTE_AUTOSTART" >> $XDEBUGINI_PATH
	    fi
	    if ! [ -v $XDEBUG_REMOTE_CONNECT_BACK ] ; then
	        echo "xdebug.remote_connect_back=$XDEBUG_REMOTE_CONNECT_BACK" >> $XDEBUGINI_PATH
	    fi
	    if ! [ -v $XDEBUG_REMOTE_HANDLER ] ; then
	        echo "xdebug.remote_handler=$XDEBUG_REMOTE_HANDLER" >> $XDEBUGINI_PATH
	    fi
	    if ! [ -v $XDEBUG_PROFILER_ENABLE ] ; then
	        echo "xdebug.profiler_enable=$XDEBUG_PROFILER_ENABLE" >> $XDEBUGINI_PATH
	    fi
	    if ! [ -v $XDEBUG_PROFILER_OUTPUT_DIR ] ; then
	        echo "xdebug.profiler_output_dir=$XDEBUG_PROFILER_OUTPUT_DIR" >> $XDEBUGINI_PATH
	    fi
	    if ! [ -v $XDEBUG_REMOTE_PORT ] ; then
	        echo "xdebug.remote_port=$XDEBUG_REMOTE_PORT" >> $XDEBUGINI_PATH
	    fi

	    echo "xdebug.remote_host="`/sbin/ip route|awk '/default/ { print $3 }'` >> $XDEBUGINI_PATH
	    echo "[ ****************** ] Ending install of XDebug and dependencies."
fi

echo "[ ****************** ] Ending Endpoint of Application"
exec "$@"
