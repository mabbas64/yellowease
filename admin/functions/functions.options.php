<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_stylesheet_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 

		$font_sizes = array(
            '10' => '10',
            '11' => '11',
            '12' => '12',
            '13' => '13',
            '14' => '14',
            '15' => '15',
            '16' => '16',
            '17' => '17',
            '18' => '18',
            '19' => '19',
            '20' => '20',
            '21' => '21',
            '22' => '22',
            '23' => '23',
            '24' => '24',
            '25' => '25',
            '26' => '26',
            '27' => '27',
            '28' => '28',
            '29' => '29',
            '30' => '30',
            '31' => '31',
            '32' => '32',
            '33' => '33',
            '34' => '34',
            '35' => '35',
            '36' => '36',
            '37' => '37',
            '38' => '38',
            '39' => '39',
            '40' => '40',
            '41' => '41',
            '42' => '42',
            '43' => '43',
            '44' => '44',
            '45' => '45',
            '46' => '46',
            '47' => '47',
            '48' => '48',
            '49' => '49',
            '50' => '50',
        );

        $google_fonts = array(
            "0" => "Select Font",
            "ABeeZee" => "ABeeZee",
            "Abel" => "Abel",
            "Abril Fatface" => "Abril Fatface",
            "Aclonica" => "Aclonica",
            "Acme" => "Acme",
            "Actor" => "Actor",
            "Adamina" => "Adamina",
            "Advent Pro" => "Advent Pro",
            "Aguafina Script" => "Aguafina Script",
            "Akronim" => "Akronim",
            "Aladin" => "Aladin",
            "Aldrich" => "Aldrich",
            "Alef" => "Alef",
            "Alegreya" => "Alegreya",
            "Alegreya SC" => "Alegreya SC",
            "Alex Brush" => "Alex Brush",
            "Alfa Slab One" => "Alfa Slab One",
            "Alice" => "Alice",
            "Alike" => "Alike",
            "Alike Angular" => "Alike Angular",
            "Allan" => "Allan",
            "Allerta" => "Allerta",
            "Allerta Stencil" => "Allerta Stencil",
            "Allura" => "Allura",
            "Almendra" => "Almendra",
            "Almendra Display" => "Almendra Display",
            "Almendra SC" => "Almendra SC",
            "Amarante" => "Amarante",
            "Amaranth" => "Amaranth",
            "Amatic SC" => "Amatic SC",
            "Amethysta" => "Amethysta",
            "Anaheim" => "Anaheim",
            "Andada" => "Andada",
            "Andika" => "Andika",
            "Angkor" => "Angkor",
            "Annie Use Your Telescope" => "Annie Use Your Telescope",
            "Anonymous Pro" => "Anonymous Pro",
            "Antic" => "Antic",
            "Antic Didone" => "Antic Didone",
            "Antic Slab" => "Antic Slab",
            "Anton" => "Anton",
            "Arapey" => "Arapey",
            "Arbutus" => "Arbutus",
            "Arbutus Slab" => "Arbutus Slab",
            "Architects Daughter" => "Architects Daughter",
            "Archivo Black" => "Archivo Black",
            "Archivo Narrow" => "Archivo Narrow",
            "Arimo" => "Arimo",
            "Arizonia" => "Arizonia",
            "Armata" => "Armata",
            "Artifika" => "Artifika",
            "Arvo" => "Arvo",
            "Asap" => "Asap",
            "Asset" => "Asset",
            "Astloch" => "Astloch",
            "Asul" => "Asul",
            "Atomic Age" => "Atomic Age",
            "Aubrey" => "Aubrey",
            "Audiowide" => "Audiowide",
            "Autour One" => "Autour One",
            "Average" => "Average",
            "Average Sans" => "Average Sans",
            "Averia Gruesa Libre" => "Averia Gruesa Libre",
            "Averia Libre" => "Averia Libre",
            "Averia Sans Libre" => "Averia Sans Libre",
            "Averia Serif Libre" => "Averia Serif Libre",
            "Bad Script" => "Bad Script",
            "Balthazar" => "Balthazar",
            "Bangers" => "Bangers",
            "Basic" => "Basic",
            "Battambang" => "Battambang",
            "Baumans" => "Baumans",
            "Bayon" => "Bayon",
            "Belgrano" => "Belgrano",
            "Belleza" => "Belleza",
            "BenchNine" => "BenchNine",
            "Bentham" => "Bentham",
            "Berkshire Swash" => "Berkshire Swash",
            "Bevan" => "Bevan",
            "Bigelow Rules" => "Bigelow Rules",
            "Bigshot One" => "Bigshot One",
            "Bilbo" => "Bilbo",
            "Bilbo Swash Caps" => "Bilbo Swash Caps",
            "Bitter" => "Bitter",
            "Black Ops One" => "Black Ops One",
            "Bokor" => "Bokor",
            "Bonbon" => "Bonbon",
            "Boogaloo" => "Boogaloo",
            "Bowlby One" => "Bowlby One",
            "Bowlby One SC" => "Bowlby One SC",
            "Brawler" => "Brawler",
            "Bree Serif" => "Bree Serif",
            "Bubblegum Sans" => "Bubblegum Sans",
            "Bubbler One" => "Bubbler One",
            "Buda" => "Buda",
            "Buenard" => "Buenard",
            "Butcherman" => "Butcherman",
            "Butterfly Kids" => "Butterfly Kids",
            "Cabin" => "Cabin",
            "Cabin Condensed" => "Cabin Condensed",
            "Cabin Sketch" => "Cabin Sketch",
            "Caesar Dressing" => "Caesar Dressing",
            "Cagliostro" => "Cagliostro",
            "Calligraffitti" => "Calligraffitti",
            "Cambo" => "Cambo",
            "Candal" => "Candal",
            "Cantarell" => "Cantarell",
            "Cantata One" => "Cantata One",
            "Cantora One" => "Cantora One",
            "Capriola" => "Capriola",
            "Cardo" => "Cardo",
            "Carme" => "Carme",
            "Carrois Gothic" => "Carrois Gothic",
            "Carrois Gothic SC" => "Carrois Gothic SC",
            "Carter One" => "Carter One",
            "Caudex" => "Caudex",
            "Cedarville Cursive" => "Cedarville Cursive",
            "Ceviche One" => "Ceviche One",
            "Changa One" => "Changa One",
            "Chango" => "Chango",
            "Chau Philomene One" => "Chau Philomene One",
            "Chela One" => "Chela One",
            "Chelsea Market" => "Chelsea Market",
            "Chenla" => "Chenla",
            "Cherry Cream Soda" => "Cherry Cream Soda",
            "Cherry Swash" => "Cherry Swash",
            "Chewy" => "Chewy",
            "Chicle" => "Chicle",
            "Chivo" => "Chivo",
            "Cinzel" => "Cinzel",
            "Cinzel Decorative" => "Cinzel Decorative",
            "Clicker Script" => "Clicker Script",
            "Coda" => "Coda",
            "Coda Caption" => "Coda Caption",
            "Codystar" => "Codystar",
            "Combo" => "Combo",
            "Comfortaa" => "Comfortaa",
            "Coming Soon" => "Coming Soon",
            "Concert One" => "Concert One",
            "Condiment" => "Condiment",
            "Content" => "Content",
            "Contrail One" => "Contrail One",
            "Convergence" => "Convergence",
            "Cookie" => "Cookie",
            "Copse" => "Copse",
            "Corben" => "Corben",
            "Courgette" => "Courgette",
            "Cousine" => "Cousine",
            "Coustard" => "Coustard",
            "Covered By Your Grace" => "Covered By Your Grace",
            "Crafty Girls" => "Crafty Girls",
            "Creepster" => "Creepster",
            "Crete Round" => "Crete Round",
            "Crimson Text" => "Crimson Text",
            "Croissant One" => "Croissant One",
            "Crushed" => "Crushed",
            "Cuprum" => "Cuprum",
            "Cutive" => "Cutive",
            "Cutive Mono" => "Cutive Mono",
            "Damion" => "Damion",
            "Dancing Script" => "Dancing Script",
            "Dangrek" => "Dangrek",
            "Dawning of a New Day" => "Dawning of a New Day",
            "Days One" => "Days One",
            "Delius" => "Delius",
            "Delius Swash Caps" => "Delius Swash Caps",
            "Delius Unicase" => "Delius Unicase",
            "Della Respira" => "Della Respira",
            "Denk One" => "Denk One",
            "Devonshire" => "Devonshire",
            "Didact Gothic" => "Didact Gothic",
            "Diplomata" => "Diplomata",
            "Diplomata SC" => "Diplomata SC",
            "Domine" => "Domine",
            "Donegal One" => "Donegal One",
            "Doppio One" => "Doppio One",
            "Dorsa" => "Dorsa",
            "Dosis" => "Dosis",
            "Dr Sugiyama" => "Dr Sugiyama",
            "Droid Sans" => "Droid Sans",
            "Droid Sans Mono" => "Droid Sans Mono",
            "Droid Serif" => "Droid Serif",
            "Duru Sans" => "Duru Sans",
            "Dynalight" => "Dynalight",
            "EB Garamond" => "EB Garamond",
            "Eagle Lake" => "Eagle Lake",
            "Eater" => "Eater",
            "Economica" => "Economica",
            "Electrolize" => "Electrolize",
            "Elsie" => "Elsie",
            "Elsie Swash Caps" => "Elsie Swash Caps",
            "Emblema One" => "Emblema One",
            "Emilys Candy" => "Emilys Candy",
            "Engagement" => "Engagement",
            "Englebert" => "Englebert",
            "Enriqueta" => "Enriqueta",
            "Erica One" => "Erica One",
            "Esteban" => "Esteban",
            "Euphoria Script" => "Euphoria Script",
            "Ewert" => "Ewert",
            "Exo" => "Exo",
            "Expletus Sans" => "Expletus Sans",
            "Fanwood Text" => "Fanwood Text",
            "Fascinate" => "Fascinate",
            "Fascinate Inline" => "Fascinate Inline",
            "Faster One" => "Faster One",
            "Fasthand" => "Fasthand",
            "Fauna One" => "Fauna One",
            "Federant" => "Federant",
            "Federo" => "Federo",
            "Felipa" => "Felipa",
            "Fenix" => "Fenix",
            "Finger Paint" => "Finger Paint",
            "Fjalla One" => "Fjalla One",
            "Fjord One" => "Fjord One",
            "Flamenco" => "Flamenco",
            "Flavors" => "Flavors",
            "Fondamento" => "Fondamento",
            "Fontdiner Swanky" => "Fontdiner Swanky",
            "Forum" => "Forum",
            "Francois One" => "Francois One",
            "Freckle Face" => "Freckle Face",
            "Fredericka the Great" => "Fredericka the Great",
            "Fredoka One" => "Fredoka One",
            "Freehand" => "Freehand",
            "Fresca" => "Fresca",
            "Frijole" => "Frijole",
            "Fruktur" => "Fruktur",
            "Fugaz One" => "Fugaz One",
            "GFS Didot" => "GFS Didot",
            "GFS Neohellenic" => "GFS Neohellenic",
            "Gabriela" => "Gabriela",
            "Gafata" => "Gafata",
            "Galdeano" => "Galdeano",
            "Galindo" => "Galindo",
            "Gentium Basic" => "Gentium Basic",
            "Gentium Book Basic" => "Gentium Book Basic",
            "Geo" => "Geo",
            "Geostar" => "Geostar",
            "Geostar Fill" => "Geostar Fill",
            "Germania One" => "Germania One",
            "Gilda Display" => "Gilda Display",
            "Give You Glory" => "Give You Glory",
            "Glass Antiqua" => "Glass Antiqua",
            "Glegoo" => "Glegoo",
            "Gloria Hallelujah" => "Gloria Hallelujah",
            "Goblin One" => "Goblin One",
            "Gochi Hand" => "Gochi Hand",
            "Gorditas" => "Gorditas",
            "Goudy Bookletter 1911" => "Goudy Bookletter 1911",
            "Graduate" => "Graduate",
            "Grand Hotel" => "Grand Hotel",
            "Gravitas One" => "Gravitas One",
            "Great Vibes" => "Great Vibes",
            "Griffy" => "Griffy",
            "Gruppo" => "Gruppo",
            "Gudea" => "Gudea",
            "Habibi" => "Habibi",
            "Hammersmith One" => "Hammersmith One",
            "Hanalei" => "Hanalei",
            "Hanalei Fill" => "Hanalei Fill",
            "Handlee" => "Handlee",
            "Hanuman" => "Hanuman",
            "Happy Monkey" => "Happy Monkey",
            "Headland One" => "Headland One",
            "Henny Penny" => "Henny Penny",
            "Herr Von Muellerhoff" => "Herr Von Muellerhoff",
            "Holtwood One SC" => "Holtwood One SC",
            "Homemade Apple" => "Homemade Apple",
            "Homenaje" => "Homenaje",
            "IM Fell DW Pica" => "IM Fell DW Pica",
            "IM Fell DW Pica SC" => "IM Fell DW Pica SC",
            "IM Fell Double Pica" => "IM Fell Double Pica",
            "IM Fell Double Pica SC" => "IM Fell Double Pica SC",
            "IM Fell English" => "IM Fell English",
            "IM Fell English SC" => "IM Fell English SC",
            "IM Fell French Canon" => "IM Fell French Canon",
            "IM Fell French Canon SC" => "IM Fell French Canon SC",
            "IM Fell Great Primer" => "IM Fell Great Primer",
            "IM Fell Great Primer SC" => "IM Fell Great Primer SC",
            "Iceberg" => "Iceberg",
            "Iceland" => "Iceland",
            "Imprima" => "Imprima",
            "Inconsolata" => "Inconsolata",
            "Inder" => "Inder",
            "Indie Flower" => "Indie Flower",
            "Inika" => "Inika",
            "Irish Grover" => "Irish Grover",
            "Istok Web" => "Istok Web",
            "Italiana" => "Italiana",
            "Italianno" => "Italianno",
            "Jacques Francois" => "Jacques Francois",
            "Jacques Francois Shadow" => "Jacques Francois Shadow",
            "Jim Nightshade" => "Jim Nightshade",
            "Jockey One" => "Jockey One",
            "Jolly Lodger" => "Jolly Lodger",
            "Josefin Sans" => "Josefin Sans",
            "Josefin Slab" => "Josefin Slab",
            "Joti One" => "Joti One",
            "Judson" => "Judson",
            "Julee" => "Julee",
            "Julius Sans One" => "Julius Sans One",
            "Junge" => "Junge",
            "Jura" => "Jura",
            "Just Another Hand" => "Just Another Hand",
            "Just Me Again Down Here" => "Just Me Again Down Here",
            "Kameron" => "Kameron",
            "Karla" => "Karla",
            "Kaushan Script" => "Kaushan Script",
            "Kavoon" => "Kavoon",
            "Keania One" => "Keania One",
            "Kelly Slab" => "Kelly Slab",
            "Kenia" => "Kenia",
            "Khmer" => "Khmer",
            "Kite One" => "Kite One",
            "Knewave" => "Knewave",
            "Kotta One" => "Kotta One",
            "Koulen" => "Koulen",
            "Kranky" => "Kranky",
            "Kreon" => "Kreon",
            "Kristi" => "Kristi",
            "Krona One" => "Krona One",
            "La Belle Aurore" => "La Belle Aurore",
            "Lancelot" => "Lancelot",
            "Lato" => "Lato",
            "League Script" => "League Script",
            "Leckerli One" => "Leckerli One",
            "Ledger" => "Ledger",
            "Lekton" => "Lekton",
            "Lemon" => "Lemon",
            "Libre Baskerville" => "Libre Baskerville",
            "Life Savers" => "Life Savers",
            "Lilita One" => "Lilita One",
            "Lily Script One" => "Lily Script One",
            "Limelight" => "Limelight",
            "Linden Hill" => "Linden Hill",
            "Lobster" => "Lobster",
            "Lobster Two" => "Lobster Two",
            "Londrina Outline" => "Londrina Outline",
            "Londrina Shadow" => "Londrina Shadow",
            "Londrina Sketch" => "Londrina Sketch",
            "Londrina Solid" => "Londrina Solid",
            "Lora" => "Lora",
            "Love Ya Like A Sister" => "Love Ya Like A Sister",
            "Loved by the King" => "Loved by the King",
            "Lovers Quarrel" => "Lovers Quarrel",
            "Luckiest Guy" => "Luckiest Guy",
            "Lusitana" => "Lusitana",
            "Lustria" => "Lustria",
            "Macondo" => "Macondo",
            "Macondo Swash Caps" => "Macondo Swash Caps",
            "Magra" => "Magra",
            "Maiden Orange" => "Maiden Orange",
            "Mako" => "Mako",
            "Marcellus" => "Marcellus",
            "Marcellus SC" => "Marcellus SC",
            "Marck Script" => "Marck Script",
            "Margarine" => "Margarine",
            "Marko One" => "Marko One",
            "Marmelad" => "Marmelad",
            "Marvel" => "Marvel",
            "Mate" => "Mate",
            "Mate SC" => "Mate SC",
            "Maven Pro" => "Maven Pro",
            "McLaren" => "McLaren",
            "Meddon" => "Meddon",
            "MedievalSharp" => "MedievalSharp",
            "Medula One" => "Medula One",
            "Megrim" => "Megrim",
            "Meie Script" => "Meie Script",
            "Merienda" => "Merienda",
            "Merienda One" => "Merienda One",
            "Merriweather" => "Merriweather",
            "Merriweather Sans" => "Merriweather Sans",
            "Metal" => "Metal",
            "Metal Mania" => "Metal Mania",
            "Metamorphous" => "Metamorphous",
            "Metrophobic" => "Metrophobic",
            "Michroma" => "Michroma",
            "Milonga" => "Milonga",
            "Miltonian" => "Miltonian",
            "Miltonian Tattoo" => "Miltonian Tattoo",
            "Miniver" => "Miniver",
            "Miss Fajardose" => "Miss Fajardose",
            "Modern Antiqua" => "Modern Antiqua",
            "Molengo" => "Molengo",
            "Molle" => "Molle",
            "Monda" => "Monda",
            "Monofett" => "Monofett",
            "Monoton" => "Monoton",
            "Monsieur La Doulaise" => "Monsieur La Doulaise",
            "Montaga" => "Montaga",
            "Montez" => "Montez",
            "Montserrat" => "Montserrat",
            "Montserrat Alternates" => "Montserrat Alternates",
            "Montserrat Subrayada" => "Montserrat Subrayada",
            "Moul" => "Moul",
            "Moulpali" => "Moulpali",
            "Mountains of Christmas" => "Mountains of Christmas",
            "Mouse Memoirs" => "Mouse Memoirs",
            "Mr Bedfort" => "Mr Bedfort",
            "Mr Dafoe" => "Mr Dafoe",
            "Mr De Haviland" => "Mr De Haviland",
            "Mrs Saint Delafield" => "Mrs Saint Delafield",
            "Mrs Sheppards" => "Mrs Sheppards",
            "Muli" => "Muli",
            "Mystery Quest" => "Mystery Quest",
            "Neucha" => "Neucha",
            "Neuton" => "Neuton",
            "New Rocker" => "New Rocker",
            "News Cycle" => "News Cycle",
            "Niconne" => "Niconne",
            "Nixie One" => "Nixie One",
            "Nobile" => "Nobile",
            "Nokora" => "Nokora",
            "Norican" => "Norican",
            "Nosifer" => "Nosifer",
            "Nothing You Could Do" => "Nothing You Could Do",
            "Noticia Text" => "Noticia Text",
            "Noto Sans" => "Noto Sans",
            "Noto Serif" => "Noto Serif",
            "Nova Cut" => "Nova Cut",
            "Nova Flat" => "Nova Flat",
            "Nova Mono" => "Nova Mono",
            "Nova Oval" => "Nova Oval",
            "Nova Round" => "Nova Round",
            "Nova Script" => "Nova Script",
            "Nova Slim" => "Nova Slim",
            "Nova Square" => "Nova Square",
            "Numans" => "Numans",
            "Nunito" => "Nunito",
            "Odor Mean Chey" => "Odor Mean Chey",
            "Offside" => "Offside",
            "Old Standard TT" => "Old Standard TT",
            "Oldenburg" => "Oldenburg",
            "Oleo Script" => "Oleo Script",
            "Oleo Script Swash Caps" => "Oleo Script Swash Caps",
            "Open Sans" => "Open Sans",
            "Open Sans Condensed" => "Open Sans Condensed",
            "Oranienbaum" => "Oranienbaum",
            "Orbitron" => "Orbitron",
            "Oregano" => "Oregano",
            "Orienta" => "Orienta",
            "Original Surfer" => "Original Surfer",
            "Oswald" => "Oswald",
            "Over the Rainbow" => "Over the Rainbow",
            "Overlock" => "Overlock",
            "Overlock SC" => "Overlock SC",
            "Ovo" => "Ovo",
            "Oxygen" => "Oxygen",
            "Oxygen Mono" => "Oxygen Mono",
            "PT Mono" => "PT Mono",
            "PT Sans" => "PT Sans",
            "PT Sans Caption" => "PT Sans Caption",
            "PT Sans Narrow" => "PT Sans Narrow",
            "PT Serif" => "PT Serif",
            "PT Serif Caption" => "PT Serif Caption",
            "Pacifico" => "Pacifico",
            "Paprika" => "Paprika",
            "Parisienne" => "Parisienne",
            "Passero One" => "Passero One",
            "Passion One" => "Passion One",
            "Pathway Gothic One" => "Pathway Gothic One",
            "Patrick Hand" => "Patrick Hand",
            "Patrick Hand SC" => "Patrick Hand SC",
            "Patua One" => "Patua One",
            "Paytone One" => "Paytone One",
            "Peralta" => "Peralta",
            "Permanent Marker" => "Permanent Marker",
            "Petit Formal Script" => "Petit Formal Script",
            "Petrona" => "Petrona",
            "Philosopher" => "Philosopher",
            "Piedra" => "Piedra",
            "Pinyon Script" => "Pinyon Script",
            "Pirata One" => "Pirata One",
            "Plaster" => "Plaster",
            "Play" => "Play",
            "Playball" => "Playball",
            "Playfair Display" => "Playfair Display",
            "Playfair Display SC" => "Playfair Display SC",
            "Podkova" => "Podkova",
            "Poiret One" => "Poiret One",
            "Poller One" => "Poller One",
            "Poly" => "Poly",
            "Pompiere" => "Pompiere",
            "Pontano Sans" => "Pontano Sans",
            "Port Lligat Sans" => "Port Lligat Sans",
            "Port Lligat Slab" => "Port Lligat Slab",
            "Prata" => "Prata",
            "Preahvihear" => "Preahvihear",
            "Press Start 2P" => "Press Start 2P",
            "Princess Sofia" => "Princess Sofia",
            "Prociono" => "Prociono",
            "Prosto One" => "Prosto One",
            "Puritan" => "Puritan",
            "Purple Purse" => "Purple Purse",
            "Quando" => "Quando",
            "Quantico" => "Quantico",
            "Quattrocento" => "Quattrocento",
            "Quattrocento Sans" => "Quattrocento Sans",
            "Questrial" => "Questrial",
            "Quicksand" => "Quicksand",
            "Quintessential" => "Quintessential",
            "Qwigley" => "Qwigley",
            "Racing Sans One" => "Racing Sans One",
            "Radley" => "Radley",
            "Raleway" => "Raleway",
            "Raleway Dots" => "Raleway Dots",
            "Rambla" => "Rambla",
            "Rammetto One" => "Rammetto One",
            "Ranchers" => "Ranchers",
            "Rancho" => "Rancho",
            "Rationale" => "Rationale",
            "Redressed" => "Redressed",
            "Reenie Beanie" => "Reenie Beanie",
            "Revalia" => "Revalia",
            "Ribeye" => "Ribeye",
            "Ribeye Marrow" => "Ribeye Marrow",
            "Righteous" => "Righteous",
            "Risque" => "Risque",
            "Roboto" => "Roboto",
            "Roboto Condensed" => "Roboto Condensed",
            "Roboto Slab" => "Roboto Slab",
            "Rochester" => "Rochester",
            "Rock Salt" => "Rock Salt",
            "Rokkitt" => "Rokkitt",
            "Romanesco" => "Romanesco",
            "Ropa Sans" => "Ropa Sans",
            "Rosario" => "Rosario",
            "Rosarivo" => "Rosarivo",
            "Rouge Script" => "Rouge Script",
            "Ruda" => "Ruda",
            "Rufina" => "Rufina",
            "Ruge Boogie" => "Ruge Boogie",
            "Ruluko" => "Ruluko",
            "Rum Raisin" => "Rum Raisin",
            "Ruslan Display" => "Ruslan Display",
            "Russo One" => "Russo One",
            "Ruthie" => "Ruthie",
            "Rye" => "Rye",
            "Sacramento" => "Sacramento",
            "Sail" => "Sail",
            "Salsa" => "Salsa",
            "Sanchez" => "Sanchez",
            "Sancreek" => "Sancreek",
            "Sansita One" => "Sansita One",
            "Sarina" => "Sarina",
            "Satisfy" => "Satisfy",
            "Scada" => "Scada",
            "Schoolbell" => "Schoolbell",
            "Seaweed Script" => "Seaweed Script",
            "Sevillana" => "Sevillana",
            "Seymour One" => "Seymour One",
            "Shadows Into Light" => "Shadows Into Light",
            "Shadows Into Light Two" => "Shadows Into Light Two",
            "Shanti" => "Shanti",
            "Share" => "Share",
            "Share Tech" => "Share Tech",
            "Share Tech Mono" => "Share Tech Mono",
            "Shojumaru" => "Shojumaru",
            "Short Stack" => "Short Stack",
            "Siemreap" => "Siemreap",
            "Sigmar One" => "Sigmar One",
            "Signika" => "Signika",
            "Signika Negative" => "Signika Negative",
            "Simonetta" => "Simonetta",
            "Sintony" => "Sintony",
            "Sirin Stencil" => "Sirin Stencil",
            "Six Caps" => "Six Caps",
            "Skranji" => "Skranji",
            "Slackey" => "Slackey",
            "Smokum" => "Smokum",
            "Smythe" => "Smythe",
            "Sniglet" => "Sniglet",
            "Snippet" => "Snippet",
            "Snowburst One" => "Snowburst One",
            "Sofadi One" => "Sofadi One",
            "Sofia" => "Sofia",
            "Sonsie One" => "Sonsie One",
            "Sorts Mill Goudy" => "Sorts Mill Goudy",
            "Source Code Pro" => "Source Code Pro",
            "Source Sans Pro" => "Source Sans Pro",
            "Special Elite" => "Special Elite",
            "Spicy Rice" => "Spicy Rice",
            "Spinnaker" => "Spinnaker",
            "Spirax" => "Spirax",
            "Squada One" => "Squada One",
            "Stalemate" => "Stalemate",
            "Stalinist One" => "Stalinist One",
            "Stardos Stencil" => "Stardos Stencil",
            "Stint Ultra Condensed" => "Stint Ultra Condensed",
            "Stint Ultra Expanded" => "Stint Ultra Expanded",
            "Stoke" => "Stoke",
            "Strait" => "Strait",
            "Sue Ellen Francisco" => "Sue Ellen Francisco",
            "Sunshiney" => "Sunshiney",
            "Supermercado One" => "Supermercado One",
            "Suwannaphum" => "Suwannaphum",
            "Swanky and Moo Moo" => "Swanky and Moo Moo",
            "Syncopate" => "Syncopate",
            "Tangerine" => "Tangerine",
            "Taprom" => "Taprom",
            "Tauri" => "Tauri",
            "Telex" => "Telex",
            "Tenor Sans" => "Tenor Sans",
            "Text Me One" => "Text Me One",
            "The Girl Next Door" => "The Girl Next Door",
            "Tienne" => "Tienne",
            "Tinos" => "Tinos",
            "Titan One" => "Titan One",
            "Titillium Web" => "Titillium Web",
            "Trade Winds" => "Trade Winds",
            "Trocchi" => "Trocchi",
            "Trochut" => "Trochut",
            "Trykker" => "Trykker",
            "Tulpen One" => "Tulpen One",
            "Ubuntu" => "Ubuntu",
            "Ubuntu Condensed" => "Ubuntu Condensed",
            "Ubuntu Mono" => "Ubuntu Mono",
            "Ultra" => "Ultra",
            "Uncial Antiqua" => "Uncial Antiqua",
            "Underdog" => "Underdog",
            "Unica One" => "Unica One",
            "UnifrakturCook" => "UnifrakturCook",
            "UnifrakturMaguntia" => "UnifrakturMaguntia",
            "Unkempt" => "Unkempt",
            "Unlock" => "Unlock",
            "Unna" => "Unna",
            "VT323" => "VT323",
            "Vampiro One" => "Vampiro One",
            "Varela" => "Varela",
            "Varela Round" => "Varela Round",
            "Vast Shadow" => "Vast Shadow",
            "Vibur" => "Vibur",
            "Vidaloka" => "Vidaloka",
            "Viga" => "Viga",
            "Voces" => "Voces",
            "Volkhov" => "Volkhov",
            "Vollkorn" => "Vollkorn",
            "Voltaire" => "Voltaire",
            "Waiting for the Sunrise" => "Waiting for the Sunrise",
            "Wallpoet" => "Wallpoet",
            "Walter Turncoat" => "Walter Turncoat",
            "Warnes" => "Warnes",
            "Wellfleet" => "Wellfleet",
            "Wendy One" => "Wendy One",
            "Wire One" => "Wire One",
            "Yanone Kaffeesatz" => "Yanone Kaffeesatz",
            "Yellowtail" => "Yellowtail",
            "Yeseva One" => "Yeseva One",
            "Yesteryear" => "Yesteryear",
            "Zeyada" => "Zeyada"
        );

	/*$alter_stylesheets = array (
			"style.css" => 'Default Stylesheet',
			"style2.css" => 'Alternate Stylesheet 1',
			"style3.css" => 'Alternate Stylesheet 2'
		); */


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "Home Settings",
						"type" 		=> "heading"
				);
					
$of_options[] = array( 	"name" 		=> "Hello there!",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Welcome to Yellow Ease Theme-Options!</h3>
						Please try the different tabs to see all the options this theme offers.",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array( "name" => "Logo",
			            "desc" => "Please choose an image file for your logo. (338x110px)",
			            "id" => "logo2",
			            "std" => get_stylesheet_directory_uri() ."/images/logo.png",
			            "mod" => "",
			            "type" => "media"); 

/* $of_options[] = array( "name" => "Theme Stylesheet",
						"desc" => "Select your theme's alternate color scheme",
						"id" => "alter_stylesheet",
						"std" => "Default Stylesheet",
						"type" => "select",
						"options" => $alter_stylesheets); */


/*$of_options[] = array( 	"name" 		=> "Media Uploader 3.5",
						"desc" 		=> "Upload images using native media uploader from Wordpress 3.5+.",
						"id" 		=> "media_upload_35",
						// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Media Uploader 3.5 min",
						"desc" 		=> "Upload images using native media uploader from Wordpress 3.5+. Min mod",
						"id" 		=> "media_upload_356",
						// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
						"std" 		=> "",
						"mod"		=> "min",
						"type" 		=> "media"
				);

$of_options[] = array( 	"name" 		=> "JQuery UI Slider example 1",
						"desc" 		=> "JQuery UI slider description.<br /> Min: 1, max: 500, step: 3, default value: 45",
						"id" 		=> "slider_example_1",
						"std" 		=> "45",
						"min" 		=> "1",
						"step"		=> "3",
						"max" 		=> "500",
						"type" 		=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "JQuery UI Slider example 1 with steps(5)",
						"desc" 		=> "JQuery UI slider description.<br /> Min: 0, max: 300, step: 5, default value: 75",
						"id" 		=> "slider_example_2",
						"std" 		=> "75",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "300",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> "JQuery UI Spinner",
						"desc" 		=> "JQuery UI spinner description.<br /> Min: 0, max: 300, step: 5, default value: 75",
						"id" 		=> "spinner_example_2",
						"std" 		=> "75",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "300",
						"type" 		=> "spinner" 
				);
				
$of_options[] = array( 	"name" 		=> "Switch 1",
						"desc" 		=> "Switch OFF",
						"id" 		=> "switch_ex1",
						"std" 		=> 0,
						"type" 		=> "switch"
				);   
				
$of_options[] = array( 	"name" 		=> "Switch 2",
						"desc" 		=> "Switch ON",
						"id" 		=> "switch_ex2",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Switch 3",
						"desc" 		=> "Switch with custom labels",
						"id" 		=> "switch_ex3",
						"std" 		=> 0,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Switch 4",
						"desc" 		=> "Switch OFF with hidden options. ;)",
						"id" 		=> "switch_ex4",
						"std" 		=> 0,
						"folds"		=> 1,
						"type" 		=> "switch"
				);*/
				
/*$of_options[] = array( 	"name" 		=> "Hidden option 1",
						"desc" 		=> "This is a sample hidden option controlled by a <strong>switch</strong> button",
						"id" 		=> "hidden_switch_ex1",
						"std" 		=> "Hi, I\'m just a text input - nr 1",
						"fold" 		=> "switch_ex4", /* the switch hook */
/*						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Hidden option 2",
						"desc" 		=> "This is a sample hidden option controlled by a <strong>switch</strong> button",
						"id" 		=> "hidden_switch_ex2",
						"std" 		=> "Hi, I\'m just a text input - nr 2",
						"fold" 		=> "switch_ex4", /* the switch hook */
/*						"type" 		=> "text"
				);
				
				
$of_options[] = array( 	"name" 		=> "Homepage Layout Manager",
						"desc" 		=> "Organize how you want the layout to appear on the homepage",
						"id" 		=> "homepage_blocks",
						"std" 		=> $of_options_homepage_blocks,
						"type" 		=> "sorter"
				);
					
$of_options[] = array( 	"name" 		=> "Slider Options",
						"desc" 		=> "Unlimited slider with drag and drop sortings.",
						"id" 		=> "pingu_slider",
						"std" 		=> "",
						"type" 		=> "slider"
				);
					
$of_options[] = array( 	"name" 		=> "Background Images",
						"desc" 		=> "Select a background pattern.",
						"id" 		=> "custom_bg",
						"std" 		=> $bg_images_url."bg0.png",
						"type" 		=> "tiles",
						"options" 	=> $bg_images,
				);
					
$of_options[] = array( 	"name" 		=> "Typography",
						"desc" 		=> "Typography option with each property can be called individually.",
						"id" 		=> "custom_type",
						"std" 		=> array('size' => '12px','style' => 'bold italic'),
						"type" 		=> "typography"
				); */


/*****************************************************
*****  GENERAL SETTINGS TAB *****
******************************************************/
$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);

					
/*$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( 	"name" 		=> "Main Layout",
						"desc" 		=> "Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.",
						"id" 		=> "layout",
						"std" 		=> "2c-l-fixed.css",
						"type" 		=> "images",
						"options" 	=> array(
							'1col-fixed.css' 	=> $url . '1col.png',
							'2c-r-fixed.css' 	=> $url . '2cr.png',
							'2c-l-fixed.css' 	=> $url . '2cl.png',
							'3c-fixed.css' 		=> $url . '3cm.png',
							'3c-r-fixed.css' 	=> $url . '3cr.png'
						)
				);*/
				
$of_options[] = array( 	"name" 		=> "Tracking Code",
						"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
						"id" 		=> "google_analytics",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
				
$of_options[] = array( 	"name" 		=> "Footer Text",
						"desc" 		=> "Add any content that you want in the bottom-most area of the page.",
						"id" 		=> "footer_text",
						"std" 		=> "&copy; 2013 Yellow Ease. All rights reserved.",
						"type" 		=> "textarea"
				);

/*****************************************************
*****  TYPOGRAPHY TAB *****
******************************************************/
		$of_options[] = array( "name" => "Typography Options",
            "type" => "heading");

		$of_options[] = array( "name" => "Google Fonts",
            "desc" => "",
            "id" => "google_fonts_intro",
            "std" => "<h3 style='margin: 0;''>Google Fonts</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array( "name" => "Select Body Font Family",
            "desc" => "Select a font family for body text",
            "id" => "google_body",
            "std" => "PT Sans",
            "type" => "select",
            "options" => $google_fonts);

        $of_options[] = array( "name" => "Select Menu Font",
            "desc" => "Select a font family for navigation",
            "id" => "google_nav",
            "std" => "Antic Slab",
            "type" => "select",
            "options" => $google_fonts);

        $of_options[] = array( "name" => "Select Headings Font",
            "desc" => "Select a font family for headings",
            "id" => "google_headings",
            "std" => "Antic Slab",
            "type" => "select",
            "options" => $google_fonts);

        $of_options[] = array( "name" => "Select Footer Headings Font",
            "desc" => "Select a font family for footer headings",
            "id" => "google_footer_headings",
            "std" => "Antic Slab",
            "type" => "select",
            "options" => $google_fonts);

/*
////// STYLING OPTIONS
*/
				
$of_options[] = array( 	"name" 		=> "Styling Options",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Theme Stylesheet",
						"desc" 		=> "Select your themes alternative color scheme.",
						"id" 		=> "alt_stylesheet",
						"std" 		=> "default.css",
						"type" 		=> "select",
						"options" 	=> $alt_stylesheets
				);
				
$of_options[] = array( 	"name" 		=> "Body Background Color",
						"desc" 		=> "Pick a background color for the theme (default: #fff).",
						"id" 		=> "body_background",
						"std" 		=> "",
						"type" 		=> "color"
				);
/*				
$of_options[] = array( 	"name" 		=> "Header Background Color",
						"desc" 		=> "Pick a background color for the header (default: #fff).",
						"id" 		=> "header_background",
						"std" 		=> "",
						"type" 		=> "color"
				);
*/
				
$of_options[] = array( 	"name" 		=> "Footer Background Color",
						"desc" 		=> "Pick a background color for the footer (default: #fff).",
						"id" 		=> "footer_background",
						"std" 		=> "",
						"type" 		=> "color"
				);
	/*			
$of_options[] = array( 	"name" 		=> "Body Font",
						"desc" 		=> "Specify the body font properties",
						"id" 		=> "body_font",
						"std" 		=> array('size' => '12px','face' => 'arial','style' => 'normal','color' => '#000000'),
						"type" 		=> "typography"
				);  */
				
$of_options[] = array( 	"name" 		=> "Custom CSS",
						"desc" 		=> "Quickly add some CSS to your theme by adding it to this block.",
						"id" 		=> "custom_css",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
	
/*
////// EXAMPLE OPTIONS

$of_options[] = array( 	"name" 		=> "Example Options",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Typography",
						"desc" 		=> "This is a typographic specific option.",
						"id" 		=> "typography",
						"std" 		=> array(
											'size'  => '12px',
											'face'  => 'verdana',
											'style' => 'bold italic',
											'color' => '#123456'
										),
						"type" 		=> "typography"
				);  
				
$of_options[] = array( 	"name" 		=> "Border",
						"desc" 		=> "This is a border specific option.",
						"id" 		=> "border",
						"std" 		=> array(
											'width' => '2',
											'style' => 'dotted',
											'color' => '#444444'
										),
						"type" 		=> "border"
				);
				
$of_options[] = array( 	"name" 		=> "Colorpicker",
						"desc" 		=> "No color selected.",
						"id" 		=> "example_colorpicker",
						"std" 		=> "",
						"type" 		=> "color"
					); 
					
$of_options[] = array( 	"name" 		=> "Colorpicker (default #2098a8)",
						"desc" 		=> "Color selected.",
						"id" 		=> "example_colorpicker_2",
						"std" 		=> "#2098a8",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Input Text",
						"desc" 		=> "A text input field.",
						"id" 		=> "test_text",
						"std" 		=> "Default Value",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Input Checkbox (false)",
						"desc" 		=> "Example checkbox with false selected.",
						"id" 		=> "example_checkbox_false",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);
				
$of_options[] = array( 	"name" 		=> "Input Checkbox (true)",
						"desc" 		=> "Example checkbox with true selected.",
						"id" 		=> "example_checkbox_true",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);
				
$of_options[] = array( 	"name" 		=> "Normal Select",
						"desc" 		=> "Normal Select Box.",
						"id" 		=> "example_select",
						"std" 		=> "three",
						"type" 		=> "select",
						"options" 	=> $of_options_select
				);
				
$of_options[] = array( 	"name" 		=> "Mini Select",
						"desc" 		=> "A mini select box.",
						"id" 		=> "example_select_2",
						"std" 		=> "two",
						"type" 		=> "select",
						"mod" 		=> "mini",
						"options" 	=> $of_options_radio
				); 
				
$of_options[] = array( 	"name" 		=> "Google Font Select",
						"desc" 		=> "Some description. Note that this is a custom text added added from options file.",
						"id" 		=> "g_select",
						"std" 		=> "Select a font",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This is my preview text!", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=> array(
										"none" => "Select a font",//please, always use this key: "none"
										"Lato" => "Lato",
										"Loved by the King" => "Loved By the King",
										"Tangerine" => "Tangerine",
										"Terminal Dosis" => "Terminal Dosis"
						)
				);
				
$of_options[] = array( 	"name" 		=> "Google Font Select2",
						"desc" 		=> "Some description.",
						"id" 		=> "g_select2",
						"std" 		=> "Select a font",
						"type" 		=> "select_google_font",
						"options" 	=> array(
										"none" => "Select a font",//please, always use this key: "none"
										"Lato" => "Lato",
										"Loved by the King" => "Loved By the King",
										"Tangerine" => "Tangerine",
										"Terminal Dosis" => "Terminal Dosis"
									)
				);
				
$of_options[] = array( 	"name" 		=> "Input Radio (one)",
						"desc" 		=> "Radio select with default of 'one'.",
						"id" 		=> "example_radio",
						"std" 		=> "one",
						"type" 		=> "radio",
						"options" 	=> $of_options_radio
				);
				
$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( 	"name" 		=> "Image Select",
						"desc" 		=> "Use radio buttons as images.",
						"id" 		=> "images",
						"std" 		=> "warning.css",
						"type" 		=> "images",
						"options" 	=> array(
											'warning.css' 	=> $url . 'warning.png',
											'accept.css' 	=> $url . 'accept.png',
											'wrench.css' 	=> $url . 'wrench.png'
										)
				);
				
$of_options[] = array( 	"name" 		=> "Textarea",
						"desc" 		=> "Textarea description.",
						"id" 		=> "example_textarea",
						"std" 		=> "Default Text",
						"type" 		=> "textarea"
				);
				
$of_options[] = array( 	"name" 		=> "Multicheck",
						"desc" 		=> "Multicheck description.",
						"id" 		=> "example_multicheck",
						"std" 		=> array("three","two"),
						"type" 		=> "multicheck",
						"options" 	=> $of_options_radio
				);
				
$of_options[] = array( 	"name" 		=> "Select a Category",
						"desc" 		=> "A list of all the categories being used on the site.",
						"id" 		=> "example_category",
						"std" 		=> "Select a category:",
						"type" 		=> "select",
						"options" 	=> $of_categories
				);

*/
				
//Advanced Settings

/*
$of_options[] = array( 	"name" 		=> "Advanced Settings",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Folding Checkbox",
						"desc" 		=> "This checkbox will hide/show a couple of options group. Try it out!",
						"id" 		=> "offline",
						"std" 		=> 0,
						"folds" 	=> 1,
						"type" 		=> "checkbox"
				);
				
$of_options[] = array( 	"name" 		=> "Hidden option 1",
						"desc" 		=> "This is a sample hidden option 1",
						"id" 		=> "hidden_option_1",
						"std" 		=> "Hi, I\'m just a text input",
						"fold" 		=> "offline", /* the checkbox hook */
/*						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Hidden option 2",
						"desc" 		=> "This is a sample hidden option 2",
						"id" 		=> "hidden_option_2",
						"std" 		=> "Hi, I\'m just a text input",
						"fold" 		=> "offline", /* the checkbox hook */
/*						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Hello there!",
						"desc" 		=> "",
						"id" 		=> "introduction_2",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Grouped Options.</h3>
						You can group a bunch of options under a single heading by removing the 'name' value from the options array except for the first option in the group.",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
				$of_options[] = array( 	"name" 		=> "Some pretty colors for you",
										"desc" 		=> "Color 1.",
										"id" 		=> "example_colorpicker_3",
										"std" 		=> "#2098a8",
										"type" 		=> "color"
								);
								
				$of_options[] = array( 	"name" 		=> "",
										"desc" 		=> "Color 2.",
										"id" 		=> "example_colorpicker_4",
										"std" 		=> "#2098a8",
										"type" 		=> "color"
								);
								
				$of_options[] = array( 	"name" 		=> "",
										"desc" 		=> "Color 3.",
										"id" 		=> "example_colorpicker_5",
										"std" 		=> "#2098a8",
										"type" 		=> "color"
								);
								
				$of_options[] = array( 	"name" 		=> "",
										"desc" 		=> "Color 4.",
										"id" 		=> "example_colorpicker_6",
										"std" 		=> "#2098a8",
										"type" 		=> "color"
								);

*/
				
// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
