<html>
	<head>
		<link rel="stylesheet" type="text/css" href="exercicio1.css">
	</head>
	<body>
		<div class="categories">
			<?php 
				define('DEFAULT_CATEGORY', 1);
				$selectedCategory = DEFAULT_CATEGORY;
				if(isset($_GET['selectedCategory'])) {
					$selectedCategory = sanitizeInput($_GET['selectedCategory']);
				}
				renderCategories($selectedCategory); 
			?>
		</div>
		<div class="items">
			<?php 				
				renderItems($selectedCategory);
			?>
		</div>

	</body>
</html>


<?php
	//BD
	//tabela_1 (id, titulo) AS categoria
	//tabela_2 (id, titulo, id_categoria) AS items


	/*
	* Render Categories based on selected category
	*/
	function renderCategories($selectedCategory) {
		$sql = 'SELECT * FROM tabela_1 AS categoria';
		$data = query($sql);
		$html = '';
		$selectedClass = ' selected';
		foreach ($data as $key => $value) {
			if($selectedCategory == $value['id']) {
				$html .= '<div class="category' .$selectedClass.'">' . $value['titulo'] . '</div>';
			} else {
				$html .= '<a class="category" href ="?selectedCategory=' . $value['id'] . '">' . $value['titulo'] . '</a>';
			}
		}
		
		return print($html);
	}

	/*
	* Render Items based on selected category
	*/
	function renderItems($selectedCategory) {
		$sql = 'SELECT * FROM tabela_2 AS items WHERE id_categoria = ' . $selectedCategory;
		$data = query($sql);
		$html = '<ul>';
		foreach ($data as $key => $value) {
			$html .= '<li class="item"> ' . $value['titulo']. ' </li>';			
		}		
		$html .= '</ul>';
		
		return print($html);
	}


	/*
	*	Returns data based on query
	*/
	function query($sql) {
		//simulate query
		$data = array();
		if($sql == 'SELECT * FROM tabela_1 AS categoria') {
			$data = array(
				0 => array('id' => 1, 'titulo' => 'categ1'),
				1 => array('id' => 2, 'titulo' => 'categ2'),
				2 => array('id' => 3, 'titulo' => 'categ3')
			);
		} elseif($sql == 'SELECT * FROM tabela_2 AS items WHERE id_categoria = 1') {
			$data = array(
				0 => array('id' => 1, 'titulo' => 'item1', 'id_categoria' => '1'),
				1 => array('id' => 2, 'titulo' => 'item2', 'id_categoria' => '1'),
			);
		} elseif($sql == 'SELECT * FROM tabela_2 AS items WHERE id_categoria = 2') {
			$data = array(
				0 => array('id' => 3, 'titulo' => 'item3', 'id_categoria' => '2')
			);
		}
		return $data;
	}

	/*
	 Remove any attempt of XSS
	*/
	function sanitizeInput($input) {
		$input = trim($input);
		if (empty($input)) {
			$input = DEFAULT_CATEGORY;
		}
		$input = strip_tags($input);

		$input = preg_replace('/[^0-9]+/', '', $input);

		return $input;
	}


?>