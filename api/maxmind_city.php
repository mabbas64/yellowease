<?php

// This code demonstrates how to lookup the country, region, city,
// postal code, latitude, and longitude by IP Address.
// It is designed to work with GeoIP/GeoLite City

// Note that you must download the New Format of GeoIP City (GEO-133).
// The old format (GEO-132) will not work.

include("../libs/maxMind/geoipcity.inc");
include("../libs/maxMind/geoipregionvars.php");

// uncomment for Shared Memory support
// geoip_load_shared_mem("/usr/local/share/GeoIP/GeoIPCity.dat");
// $gi = geoip_open("/usr/local/share/GeoIP/GeoIPCity.dat",GEOIP_SHARED_MEMORY);

$gi = geoip_open("../libs/GeoIPCity.dat",GEOIP_STANDARD);

$record = geoip_record_by_addr($gi,$_SERVER['REMOTE_ADDR']);

echo json_encode($record);
geoip_close($gi);
?>
