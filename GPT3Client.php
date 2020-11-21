<?php

//This is your Secret API Key
$secret_key = '******YOUR-Secret-KEY-HERE********';

//Making HTTP Requests
$curl = curl_init();

$model=['ada','babbage','curie','davinci','content-filter-alpha-c4'];
/*
MAX Token => Limit of Max Tokens 0-2048 -- How Many word you want to predict from Model
Temperature => Randomness for text prediction -- Between 0-1 -- (Probabilites Value 0,0.1,...0.9,1)
top_p => It also control Randomness for Predicted text but with probability mass called nucleus sampling -- between 0-1

always put change only Temperature or top_p and take 1 for other i.e temprature 0.5 then top_p=1

n => How many completions to generate for each prompt. -- values for n >= 1
stream => Boolen
for complete deatiled overview of all parameters used in this API visit here
https://beta.openai.com/docs/api-reference/create-completion
*/



curl_setopt_array($curl, [
	CURLOPT_URL => "https://api.openai.com/v1/engines/".$model[3]."/completions",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => '{
        "prompt": "This is a test",
        "max_tokens": 5,
        "temperature": 0.25,
        "top_p": 1,
        "n": 1,
        "stream": false,
        "logprobs": null,
        "stop": "\n",
        "presence_penalty": 0,
        "frequency_penalty": 0,
        "best_of": 1,
        "logit_bias": null,
    }',
	CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization:' . $secret_key
        //{for Orgnization} 'OpenAI-Organization': $secret_key
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "CURL Error #:" . $err;
} else {
	echo $response;
}

?>
