<link href="<?php echo URL; ?>Styles/Styles/CssRu.css" rel="stylesheet">
<link href="<?php echo URL; ?>Styles/Styles/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo URL; ?>Styles/Styles/CssSubMenu.css" rel="stylesheet">
<link href="<?php echo URL; ?>Styles/Styles/css.css" rel="stylesheet">
<link href="<?php echo URL; ?>Styles/Styles/Menu.css" rel="stylesheet">

<link href="<?php echo URL; ?>Styles/Styles/csstips.css" rel="stylesheet">
<!--
<div class="jumbotron text-center inicio" style="margin-bottom: 0px;">
	<h1 class="inicio"><?php echo($Helps->Titulo); ?></h1>
	<p class="inicio">Panel De Ayuda "<?php echo($Helps->Titulo); ?>"</p>
</div>
-->
<table class="table">
	<thead>
		<tr class="info">
			<th style="text-align:center;">
				<button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">Ver Ayuda.
				</button>
			</th>
		</tr>
	</thead>
</table>
<div id="myModal" class="modal fade">
	<center>
	<div class="Tips">
		<div class="row">
			<div class="col-sm-12">
				<h2 class="Tip" style="font-size: 36;"><?php echo($Helps->Titulo); ?></h2>
			</div>
		</div>
		<div class="row">
			<?php
				//echo(count($Helps->Elementos));
				$Columnas = floor(12/(count($Helps->Elementos)));
				for($i=0;$i<count($Helps->Elementos);$i++){
					echo('<div class="col-sm-' . $Columnas . '">');
					for($j=0;$j<count($Helps->Elementos[$i]);$j++){
						$size = floor(36 - (4 * (count($Helps->Elementos))));
						if($size < 16){$size = 16;}
						if($j==1){$size = $size -4;}
						if($j>1){$size = $size -8;}
						
						if($j==0){echo('<h3 class="Tip" style="font-size: ' . $size . ';">' . $Helps->Elementos[$i][$j] . '</h3>');}
						if($j==1){echo('<h4 class="Tip" style="font-size: ' . $size . ';">' . $Helps->Elementos[$i][$j] . '</h4>');}
						if($j>1){echo('<p class="Tip" style="font-size: ' . $size . ';">' . $Helps->Elementos[$i][$j] . '</p>');}
					}
					echo('</div>');
				}
			?>
		</div>
	</div>
	</center>
</div>


