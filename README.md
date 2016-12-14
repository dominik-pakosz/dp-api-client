# Sample DP API Client
Sample client for DocPlanner API v3

- Clone the project into a directory
- `cd` into project directory 
- run `php composer install`

### Requirements
- Http Server like nginx or Apache
- PHP

#### Note:
This is not a production ready application, this application might require many improvements. It's just an application to show you how you can integrate with DocPlanner API v3.
If you want to use any parts of the code, feel free, but remember about adding some validations/improvements.

### NGINX configuration
	server {
	    listen 5000;
	    server_name local.*;

	    root /path/to/project/dp-api-client/web;

	    access_log /usr/local/etc/nginx/logs/dp-api-access.log;
	    error_log  /usr/local/etc/nginx/logs/dp-api-error.log error;

	    index app.php index.html index.htm;

	    try_files $uri $uri/ @rewrite;

	    location @rewrite {
	        rewrite ^/(.*)$ /app.php/$1;
	        autoindex on;
	    }

	    location ~ \.php {
	        #assuming that your php-fpm is running on 9001 port
	        fastcgi_index app.php;
	        fastcgi_pass 127.0.0.1:9001; 

	        fastcgi_buffer_size 32k;
	        fastcgi_buffers 64 32k;
	        fastcgi_read_timeout 300;

	        include fastcgi_params;
	        fastcgi_split_path_info ^(.+\.php)(/.+)$;
	        fastcgi_param PATH_INFO $fastcgi_path_info;
	        fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
	        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;

	        fastcgi_param SERVER_NAME $host;
	    }

	    location ~ /\.ht {
	        deny all;
	    }
	}
