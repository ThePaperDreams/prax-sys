<?php 
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . "/librerias/orgChart/prettify.js"]);
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . "/librerias/orgChart/prettify.css"]);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . "/librerias/orgChart/jOrgChart.js"]);
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . "/librerias/orgChart/jOrgChart.css"]);
 ?>
     <script>
    jQuery(document).ready(function() {
        $("#org").jOrgChart({
            chartElement : '#chart',
            dragAndDrop  : false
        });
    });
    </script>
    <!-- <div class="contenedor" style=""> -->
    	
		<ul id="org" style="display: none;">
			<li>
				Menú
				<ul>
					<?php foreach ($padres as $padre): ?>
						<li>
						<?= $padre->nombre ?>
						<?php if (count($padre->hijos) > 0): ?>
							<ul>
							<?php foreach ($padre->hijos as $segundoNivel): ?>
								<li>										
								<?= $segundoNivel->nombre ?>
								<?php if (count($segundoNivel->hijos) > 0): ?>
									<ul>
										<?php foreach ($segundoNivel->hijos as $tercerNivel): ?>
										<li><?= $tercerNivel->nombre ?></li>
										<?php endforeach ?>
									</ul>
								<?php endif ?>
								</li>
							<?php endforeach ?>
							</ul>
						<?php endif ?>
						</li>
					<?php endforeach ?>					
				</ul>
			</li>
		</ul>
    <!-- </div> -->
    <!-- <ul id="org" style="display:none">
    <li>
       Food
       <ul>
         <li id="beer">Beer</li>
         <li>Vegetables
           <a href="http://wesnolte.com" target="_blank">Click me</a>
           <ul>
             <li>Pumpkin</li>
             <li>
                <a href="http://tquila.com" target="_blank">Aubergine</a>
                <p>A link and paragraph is all we need.</p>
             </li>
           </ul>
         </li>
         <li class="fruit">Fruit
           <ul>
             <li>Apple
               <ul>
                 <li>Granny Smith</li>
               </ul>
             </li>
             <li>Berries
               <ul>
                 <li>Blueberry</li>
                 <li><img src="images/raspberry.jpg" alt="Raspberry"/></li>
                 <li>Cucumber</li>
               </ul>
             </li>
           </ul>
         </li>
         <li>Bread</li>
         <li class="collapsed">Chocolate
           <ul>
             <li>Topdeck</li>
             <li>Reese's Cups</li>
           </ul>
         </li>
       </ul>
     </li>
   </ul> -->
    
    <div id="chart" class="orgChart" style="width: 100%; overflow-x: scroll;"></div>
    
    <script>
        jQuery(document).ready(function() {
            
            /* Custom jQuery for the example */            
            
            // $("#org").bind("DOMSubtreeModified", function() {
            //     $('#list-html').text('');
                
            //     $('#list-html').text($('#org').html());
                
            //     prettyPrint();                
            // });
        });
    </script>