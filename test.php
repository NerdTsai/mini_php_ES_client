<?php 
	require('mini_elasticsearch.php');
 	$ES = new Elasticsearch();
    	$ES->setDomain('10.10.10.10:9200');
    	$ES->setIndex('great');
		$ES->setType('bug');


    	$search = array(
		'query'=>array(
			'match'=>array(
				'id'=>'1'
			)		
		)
	);

	$Response = $ES->search($search);
	print_r($Response);

?>

