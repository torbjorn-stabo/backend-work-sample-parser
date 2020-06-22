<p align="center"><img src="https://sp-cdn.mytaste.org/images/logo-full.svg?v=197" height="50px"></p>

## Backend work sample configuration parser

##### Delivery
Work in your own git and send us a link to your repo.

##### Restrictions
You should use vanilla PHP without any framework.

##### The assignment
Given the file "config.txt", with the following content:

***
    # Main configuration file
    db.host = "10.0.0.55"
    db.port = 3306
    db.name.internal = "db­01­internal.local" 
    db.name.external = "db­01.company.tld"

    cache.ttl = 3600
    
    debug.enabled = false
    ##### NOTE: keep the connection timeout low cache.connection.timeout = 3

Create a function that reads & converts the above file into a multi­dimensional array. 
The parser should be able to handle unlimited numbers of levels in config.

The output should yield exactly 
the following when run through var_dump():

        array(3) { 
            ["db"]=> 
            array(3) {
                ["host"]=> 
                string(9) "10.0.0.55" 
                ["port"]=> 
                int(3306) 
                ["name"]=> 
                array(2) {
                ["internal"]=>
                string(20) 
                    "db­01­internal.local" 
                ["external"]=>
                    string(17) "db­01.company.tld"                                     
                } 
            }
            ["cache"]=> 
            array(2) {
                ["ttl"]=> 
                int(3600) 
                ["connection"]=> 
                array(1) {
                    ["timeout"]=>
                    int(3) 
                }
            } 
            ["debug"]=> 
            array(1) {
                ["enabled"]=>
                bool(false) 
            }
        }