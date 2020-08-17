<?php
$filtered_data = [];
function getAccesToken ()
{
	$authUrl = "https://allegro.pl/auth/oauth/token?grant_type=client_credentials";
	$clientId = "22795e5e1182477b8176e2d809b068e0";
	$clientSecret = "WIiOJGDtnUiGt3V5kSIMmNtIJMNsX4KvwwdkC3xEKbQ6bRXG2bJWDX4jN0wrvW2G";
	
	
	$ch = curl_init($authUrl);
	curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERNAME, $clientId);
    curl_setopt($ch, CURLOPT_PASSWORD, $clientSecret);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	
	$tokenResult = curl_exec($ch);
	$resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	
		
	$tokenObject = json_decode($tokenResult);
	return $tokenObject->access_token;
}

function GetMyOffers(String $token)
{
	$GetMyOffersUrl = "https://api.allegro.pl/offers/listing?seller.id=9712221&id$sort=-relevance";
	$ch = curl_init("$GetMyOffersUrl");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
                 "Accept: application/vnd.allegro.public.v1+json",
				   "Authorization: Bearer $token"
    ]);
	$mainOffersResult = curl_exec($ch);
	$resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	if($mainOffersResult === false || $resultCode !== 200)
		{
			exit ("Blad");
		}
	$OffersList = json_decode($mainOffersResult,true);
	return $OffersList;
	
}
function FilteredData($JsonFile)
{
	$json_data = $JsonFile['items']['promoted'];
	for($i=0; $i< count($json_data); $i++)
	{
		$item = $json_data[$i];
		$filtered_data[$i] = array(
      "id" => $item["id"],
   );
   
	}
	return $filtered_data;
}
function getBillings($id)
{
	$GetMyOffersUrl = "https://api.allegro.pl/billing/billing-entries?offer.id=$id";
	echo $GetMyOffersUrl;
	$ch = curl_init("$GetMyOffersUrl");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
                 "Accept: application/vnd.allegro.public.v1+json",
				   "Authorization: Bearer $token"
    ]);
	$mainOffersResult = curl_exec($ch);
	$resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	if($mainOffersResult === false || $resultCode !== 200)
		{
			exit ("Blad");
		}
	$BillingList = json_decode($mainOffersResult,true);
	return $BillingList;
}

function main ()
{
	$token = getAccesToken();
	$JsonFile = GetMyOffers($token);
	$returnFilter = FilteredData($JsonFile);
	foreach ($returnFilter as $value)
			{	
				getBillings($value['id']);
			}
	
}
main();
?>