@extends('layouts.app')

@section('main')
<div class="uk-container" uk-filter="target: .js-filter; animation: slide">
	<h2 class="uk-h1 uk-text-center">Gestión de servicios</h2>
	<p class="uk-text-center">Este portal permite a los usuarios obtener acceso por sí solos a los mejores servicios de TI. <span class="uk-text-bold">¿Qué necesitas?</span></p>

	<!-- COMIENZA OPCIONES -->
	<div>
		<ul class="uk-subnav uk-subnav-pill">
			<li class="uk-active" uk-filter-control><a href="#">Todo</a></li>

			@foreach ($tags as $tag => $service)
			<li uk-filter-control="filter: [tag='{{ str_replace(" ", "", $tag) }}']; group: tag" style="margin: 2px;">
				<a href="#" uk-toggle="target: .toggle-{{ str_replace(" ", "", $tag) }}">
					{{ $service }}
				</a>
			</li>
			@endforeach

			<li>
				<div class="uk-width-auto uk-text-nowrap">
				<span class="uk-active" uk-filter-control="selActive: true; sort: tag-rate"><a class="uk-icon-link" href="#" uk-icon="icon: arrow-down" uk-tooltip="title: -rate; pos: top; delay: 500"></a></span>
    			<span uk-filter-control="selActive: true; sort: tag-rate; order: desc"><a class="uk-icon-link" href="#" uk-icon="icon: arrow-up" uk-tooltip="title: +rate; pos: top; delay: 500"></a></span>
    			</div>
			</li>
	    </ul>
	</div>
	<!-- FINALIZA OPCIONES -->

	<!-- COMIENZA FILTRO AVANZADO -->
	<form>
	<ul class="uk-subnav uk-subnav-pill" uk-form-custom="target: true">

	<?php $index = ["language"=>"lang", "OS"=>"platf", "framework"=>"fram", "database"=>"dat"]; $elem_usado = []; ?>

	@foreach ($users as $user)

		<li class="toggle-{{ $user["tag"] }}"></li>
		
		@foreach($index as $ind => $tagElem)
			@foreach($user[$ind] as $elem)
				@if(in_array($elem, $elem_usado))
					@continue
				@endif

				<?php array_push($elem_usado, $elem); ?>

				<li uk-filter-control="selActive: true; filter: [tag-{{ $tagElem }}*='{{ $elem }}']; group: tag-{{ $tagElem }}"><a href="#" class="toggle-{{ str_replace(" ", "", $user["tag"]) }}" hidden>{{ $elem }}</a></li>

			@endforeach
		@endforeach
		
	@endforeach

	</ul>
	</form>
	<!-- FINALIZA FILTRO AVANZADO -->

	<!-- COMIENZA FILTER -->
	<div class="uk-child-width-1-3@m uk-child-width-1-2@s uk-grid-match uk-text-center uk-margin-medium-top js-filter" uk-grid>

		@set($i=0)

		@foreach ($users as $user)

			{{-- TAGS DEL FILTRO --}}
			{{ UserController::printList($user, ["OS"=>"platf", "language"=>"lang", "framework"=>"fram", "database"=>"dat"]) }}

				<div class="uk-card uk-card-default uk-box-shadow-medium uk-card-hover uk-card-body uk-inline uk-transition-toggle">
					<div class="uk-card-badge uk-label">{{ $user["service"] }}</div>
					<div class="uk-flex-last@s uk-card-media-center uk-cover-container">
				        <img src="@asset('img/'.$user["tag"].'-dev.jpg')" alt="{{ $user["tag"] }}" uk-cover>
				        <canvas width="600" height="400"></canvas>
				        <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
			                <div class="uk-margin-remove uk-align-center">
			                <button class="uk-button uk-button-default" uk-toggle="modal-{{ $i }}">Ver más</button>
			                </div>
			                <!-- COMIENZA MODAL -->
			                <div id="modal-{{ $i }}" uk-modal>
							    <div class="uk-modal-dialog uk-modal-body">
							        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
							        <div class="uk-grid-collapse uk-text-center uk-margin uk-flex-center" uk-grid>
							            <div class="uk-padding-large uk-text-emphasis">
							                <h1>{{ $user["name"] }}</h1>
							                <p>{{ $user["description"] }}</p>
										
							            {{-- COMIENZA LISTADO DE LENGUAJES --}}
										@if(null !== $user["language"])
											<div>
											@foreach($user["language"] as $lang)
												<span class="uk-label uk-label-success" style="margin-right: 2px">{{ $lang }}</span>
											@endforeach
											</div>
							       		@endif
							       		{{-- FINALIZA LISTADO DE LENGUAJES --}}

							       		@if(null !== $user["img"])
							       			@foreach($user["img"] as $imgUrl)
							       				<img data-src="img/{{ $imgUrl }}" width="700" height="500" alt="{{ $imgUrl }}" uk-img>
							       			@endforeach
							       		@endif

							        	</div>
							        	<div class="uk-align-center">
							            {{-- COMIENZA CONTACTOS --}}
										@foreach ( $user["contact"] as $contact => $value)
											@if(strcmp($contact, "telegram") == 0)
												<a href="https://www.t.me/{{ $value }}" class="uk-margin-right" target=”_blank” rel="nofollow"><img src="@asset('img/telegram-icon.png')" width="20" height="20" uk-tooltip="title: {{ $value }}; pos: bottom; delay: 500"></a>
											@elseif(null !== $contact)
												@foreach ($social_media as $app => $link)
													@if(strcmp($contact, $app) == 0)
														<a href="{{ $link}}{{ $value }}" class="uk-margin-right" uk-icon="icon: {{ $app }}" target=”_blank” rel="nofollow" uk-tooltip="title: {{ $value }}; pos: bottom; delay: 500"></a>
													@endif
												@endforeach
											@endif
										@endforeach
										{{-- FINALIZA CONTACTOS --}}
										</div>
							        </div>
							    </div>
							</div>
							<!-- FINALIZA MODAL -->
			            </div>
				    </div>
					<a class="uk-position-cover" uk-toggle="target: #modal-{{ $i }}"></a>
					<h3 class="uk-card-title uk-margin">{{ $user["name"] }}</h3>
					<p>{{ substr($user["description"], 0,120) }}...</p>
					<p><span class="uk-label">{{ $user["rate"] }}$/h</span></p>
				</div>
			</div>
			@set($i)
		@endforeach

	</div>
	<!-- END FILTER -->
</div>
</div>
@endsection

@section('footer')
	<div class="uk-text-center uk-text-muted uk-padding-small"><span>¿Quieres aparecer en la menú?</span> <a class="uk-text-bold uk-link-reset" href="#" rel="nofollow" target=”_blank” uk-tooltip="title: Whatsapp; pos: right; delay: 500">¡Contáctanos!</a></div>
@endsection