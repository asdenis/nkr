<section>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	foreach ($drinks as $d)
	{
		//echo $r->nombre.'<br/>';
		echo '
		<article>
			<p class="titulo">'.$d->drink.'</p>
			<img src="assets/img/tragos/'.$d->img.'">
			<div class="status">
				<ul class="datos">
					<li><img class="icono" src="assets/img/iconos/admin.png">creado por: <a href="#">'.$d->user.'</a></li>
					<li><img class="icono" src="assets/img/iconos/date.png">'.$d->fecha.'</li>
				</ul>
				<ul class="ref">
					<li><img class="icono" src="assets/img/iconos/like.png">(125)</li>
					<li><img class="icono" src="assets/img/iconos/star.png">(4.3)</li>
					<li><a href="#"><img class="icono" src="assets/img/iconos/mas.png">mas</a></li>
				</ul>
			</div>';
			// AGREGA LOS COMENTARIOS A CADA TRAGO

			foreach ($comments as $c) 
			{
				if($c->drink == $d->drink)
				{
					echo '
					<div class="comentarios">
						<div class="entrada">
							<img src="assets/img/users/'.$c->img.'"></img>
							<p>
								<a href="#">'.$c->user.': </a>'.$c->comentario.'
							</p>
						</div>
					</div>
					';
				}
			}


			// TERMINA EL ARTICLE
			echo '
		</article>
		';
	}

?>
</section>