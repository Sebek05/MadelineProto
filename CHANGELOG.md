# Changelog

## 4.0.0 Full async

**Fully asynchronous MadelineProto!**

MadelineProto now features async, for **incredible speed improvements**, and **parallel processing**.
Powered by [amphp](https://amphp.org), MadelineProto wraps the AMPHP APIs to provide a simpler generator-based async API.  

* Fully rewritten connection stack, with support for websockets, stuff
* updates
* simultaneous method calls
* new TL callback system
* added support for wallpapers
* Improved message splitting algorithm: performance improvements, and it will now notify you via the logs if there are too many entities in the logs, or if the entities are too long.  
* Improved get_self method.  
* reference database
* Rewritten proxy stack
* magic sleep
* get_full_dialogs
* new APIfactory
* sendmessage with secret messages
* automatic secret chat file upload
* 2fa+++++
* improved callfork
* split acks
* new logging
* TL callabck
* channel state
* logger
* async construct
* clean up repo, update dependencies and remove curl dependency
* new phone call config
* updated php-libtgvoip
* improved madeline.php loader
* async constructor
* removed old serialization 
* rewrote combined update handler (async)
* modify amphp
* async logging
* phpdoc
* @support
* even without access hash for bots
* async HTTP requests internally
* custom HTTP client with DoH
* no more php 5
* reset PTS to 0
* arrayaccess on args

Things to expect in the next releases:
docs for get mime funcs
docs for update_2fa
docs for ResponseException
docs for PTSException
Document async apis
optional max_id and min_id
async iterators
Method name changes
#MadelineProtoForNode async
lua async
improved get_pwr_chat
gzip
no defer logs
recover@tg docs
startedLoop docs

no error setting, madelineproto does that for you


do not use manual
tell about madeline.php loading in the same dire
arrayaccess on promises
