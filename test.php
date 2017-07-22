<?php
/**
 * Created by PhpStorm.
 * User: Gurcan
 * Date: 22.07.2017
 * Time: 23:49
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';

use \IGA\VideoEmbedAssembler\videoEmbedAssembler;

echo videoEmbedAssembler::convertText("Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium, amet blanditiis dolore ea, eum eveniet, excepturi explicabo harum iure odio optio reprehenderit suscipit. Accusantium aliquam https://www.youtube.com/watch?v=8d97CGyglS4 facilis fugiat illo laboriosam libero nihil numquam optio perspiciatis quae. Ab asperiores at atque cupiditate eaque, https://vimeo.com/226441556 fugiat labore neque non pariatur quae quis vitae!");

