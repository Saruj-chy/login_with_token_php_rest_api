# login_with_token_php_rest_api
<p> This is a PHP REST API that details how to secure the API using an access token in an XAMPP database. A secret key of 32/62 bytes is generated using a secret key file. An access token is then created using this secret key and a payload, utilizing the Firebase JWT class, with an expiration time of up to 5 minutes. The complete process for generating and using an access token can be found in the `token_api` folder. Two types of access token and refresh token are used, where the access token will be given to the user each time and the refresh token will be saved in the database. There are two types of tokens: an access token and a refresh token. The access token is provided to the user each time, while the refresh token is stored in the database </p> <br/>

<p> Additionally, a rate limit logging API is implemented, located in the `rate_limit_api` folder. This API tracks how many times an endpoint is called per minute. It allows a maximum of 10 API calls per minute; if exceeded, an error message will be displayed, and the API request will not be processed.
</p>

## Step by Step:
1. To use Firebase's JWT package, check the composer version. Composer version 2.x will be good. <br/>
composer -V <br/> <br/>

2. Install Composer to use the JWT package. <br/>
composer require firebase/php-jwt <br/><br/>


* Access token all api in token_api_folder: <br/>
* Rate Limit log check all api in rate_limit_api folder: <br/>

## Database Files Link:
<a href="https://github.com/Saruj-chy/login_with_token_php_rest_api/tree/main/database"> Database Files Link </a>

