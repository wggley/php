<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css">	
</head>
<body>
	<section>		
		<div class="categories">
			<ul>
			<?php foreach($categories as $category) : ?>
				<li class="category<?php echo $_GET['id_category'] == $category['id'] ? ' selected' : ''; ?>">
					<a  href="?id_category=<?php echo $category['id']; ?>"><?php echo $category['name'] ?></a>
				</li>
			<?php endforeach ?>
		</div>
		<?php if(count($items) > 0) : ?>
			<div class="search">
				<form method="get">
					Pesquisar:
					<input name="search" value="<?php echo isset($_GET['search'])?  $_GET['search'] :''; ?>">
					<input type="hidden" name="id_category" value="<?php echo isset($_GET['id_category'])?  $_GET['id_category'] :''; ?>">
					<input type="submit">
				</form>			
			</div>
			<div class="order">
				Ordenar por:
				<span>titulo 
					(<a href="?id_category=<?php echo $_GET['id_category']; ?>&titulo=asc" class="<?php echo $_GET['titulo'] == 'asc' ? 'selected' : 'notselected'; ?>">ascendente</a>/<a href="?id_category=<?php echo $_GET['id_category']; ?>&titulo=desc" class="<?php echo $_GET['titulo'] == 'desc' ? 'selected' : 'notselected'; ?>">descendente</a>)
				</span>
				<span>antiguidade 
					(<a href="?id_category=<?php echo $_GET['id_category']; ?>&createdon=asc" class="<?php echo $_GET['createdon'] == 'asc' ? 'selected' : 'notselected'; ?>">ascendente</a>/<a href="?id_category=<?php echo $_GET['id_category']; ?>&createdon=desc" class="<?php echo $_GET['createdon'] == 'desc' ? 'selected' : 'notselected'; ?>">descendente</a>)
				</span>
				<span>(<a href="?id_category=<?php echo $_GET['id_category']; ?>&random=asc" class="<?php echo $_GET['random'] == 'asc' ? 'selected' : 'notselected'; ?>">aleatorio</a>)</span>
			</div>
			<ul class="pages">
				<?php if ($pages > 1) : ?>
				Páginas:
					<?php for ($i=1; $i <= $pages; $i++) : ?>
						<li class="<?php echo $_GET['page'] == $i ? 'selected' : 'notselected'; ?>">
							<a href="?<?php echo queryStringAdd('page', $i);?>"><?php echo $i;?></a>
						</li>
					<?php endfor ?>
				<?php endif ?>
			</ul>
			<div class="items">
				<ul>
					<li class="item">
						<span class="titulo">titulo</span>
						<span class="texto">texto</span>
					</li>
					<?php foreach($items as $item) : ?>
						<li class="item">
							<?php
								$needle = isset($_GET['search']) ?  $_GET['search'] : '';
								$item['titulo'] = highlightStr($item['titulo'], $needle, 'highlighted');
								$item['texto'] = highlightStr($item['texto'], $needle, 'highlighted');
							?>
							<span class="titulo"><?php echo $item['titulo']; ?></span>
							<span class="texto"><?php echo $item['texto']; ?></span>
						</li>
					<?php endforeach ?>					
				</ul>				
			</div>
		<?php endif ?>		
	</section>
</body>
</html>