<!-- Name Info -->

<div class="row justify-content-center" id="artistHeadInfo">

	<div class="col-12 text-center">

		<? if($userInfo_array['id_type_user'] == '1'): ?>
			<h1 class="mb-0"><?=$userInfo_array['nick_user']?></h1>
		<? elseif($userInfo_array['id_type_user'] == '2'): ?>
			<h1 class="mb-0"><?=ucfirst($userInfo_array['first_name_user'])?> <?=ucfirst($userInfo_array['last_name_user'])?></h1>
		<? endif; ?>
		<h1>Panel de Control</h1>

		<h2 class="mb-0">Revisa tus eventos y administra tus datos.</h2>

	</div>

</div>



<!-- Accordion panels -->

<div class="accordion mt-5" id="accordionDashboard">



	<!-- Events Data User -->

<div class="card">

    <div class="card-header" id="headingMyEvents">

    	<h2 class="mb-0">

	        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseMyEvents" aria-expanded="true" aria-controls="collapseMyEvents">

	          Mis Reservas <i class="fas fa-caret-down"></i>

	        </button>

    	</h2>

    </div>

    <div id="collapseMyEvents" class="collapse" aria-labelledby="headingMyEvents" data-parent="#accordionDashboard"  >

    	<div class="container">

      		<div  class="card-body">
      			<!--<div class="row text-center my-4">
      				<div class="col-md-8 offset-md-2">
	        			<button type="" class="eventosbotones-primary m-2" data-toggle="modal" data-target="#invitacionesModal">Invitaciones</button>

	        			<button type="" class="eventosbotones-outline m-2" data-toggle="modal" data-target="#aceptadasModalLabel">Aceptadas</button>

	        			<button type="" class="eventosbotones-outline m-2" data-toggle="modal" data-target="#confirmadasModalLabel">Confirmadas</button>
					</div>
				</div>-->
				<div class="row">
      				<div class="col-md-10 offset-md-1 pl-0">
	        			<p class="font-weight-bold mb-0">Eventos</p>

						<p>Estas son tus reservas agendadas. Recuerda revisar cada una para aceptarlos o rechazarlos.</p>
					</div>
				</div>

				<!-- Status Description -->

				<div class="row mt-5">


					<div class="col-md-2 col-5 offset-md-1" id="statusDesc-reserved">

						<p class="font-weight-bold">Reservado</p>

						<p class="status-desc">Tienes una reserva pendiente por confirmar o rechazar.</p>

					</div>

					<div class="col-md-2 col-5" id="statusDesc-pending">

						<p class="font-weight-bold">Pendiente</p>

						<p class="status-desc">Pago pendiente por parte del cliente para confirmar el evento.</p>

					</div>

					<div class="col-md-2 col-5" id="statusDesc-confirmed">

						<p class="font-weight-bold">Confirmado</p>

						<p class="status-desc">Servicio confirmado entre ambas partes.</p>

					</div>

					<div class="col-md-2 col-5" id="statusDesc-published">

						<p class="font-weight-bold">Publicado</p>

						<p class="status-desc">Evento publicado en cartelera EchoMusic.</p>

					</div>

				</div>

				<!-- Select Month Year -->

				<div class="row justify-content-center mt-5">

					<div class="col-md-5">

						<label class="font-weight-bold" for="monthEventsSelect">Mes</label>

						<select class="form-control form-custom-1" id="dropdownMonth" onChange="changeInboxEvents()">

							<? foreach($arrayMonths as $key => $months): ?>
               <? $selected = ($currentMonth == $key) ? "selected" : "" ?>
                	<option value="<?=$key?>" <?=$selected?>><?=$months?></option>
                <? unset($selected); ?>
              <? endforeach; ?>

						</select>

					</div>

					<div class="col-md-5">

						<label class="font-weight-bold" for="yearEventsSelect">Año</label>

						<select class="form-control form-custom-1" id="dropdownYear" onChange="changeInboxEvents()">

							<? foreach($arrayYears as $years): ?>
                <? $selected = ($currentYear == $years) ? "selected" : "" ?>
                	<option value="<?=$years?>" <?=$selected?>><?=$years?></option>
                <? unset($selected); ?>
              <? endforeach; ?>

						</select>

					</div>

				</div>

				<!-- Inbox -->

				<div  id="event_listContainer" class="row mt-5 justify-content-center">

					<div class="col-md-9 table-responsive">

						<table class="table">

						  <thead>

						    <tr>

						      <th scope="col">Fecha</th>

						      <th scope="col">Hora</th>

						      <th scope="col">Nombre</th>

						      <th class="text-center" scope="col">Estado</th>

						    </tr>

						  </thead>

						  <tbody id="event_listTableBody">
								<? foreach($arrayEvents as $events): ?>
						     <? $time = date_create($events['date_event']); ?>
						        <tr>
						        <th scope="row"> <?getDayday($time);?> </th>
						        <td><?=DATE_FORMAT($time, 'H:i')?></td>
						        <td><a  role="button" class="a-evento" onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()" ><?=$events['name_event']?></a></td>
						        <? switch($events['status_event']): ?>
<? case "reserved": ?>
						          <td class="text-center status-dot-reserved"><a  onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()"><i class="fas fa-circle"></i></a></td>
						          <? break; ?>
						          <? case "pending": ?>
						          <td class="text-center status-dot-pending"><a  onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()"><i class="fas fa-circle"></i></a></td>
						          <? break; ?>
						          <? case "confirmed": ?>
						          <td class="text-center status-dot-confirmed"><a  onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()"><i class="fas fa-circle"></i></a></td>
						          <? break; ?>
						          <? case "canceled": ?>
						          <td class="text-center status-dot-canceled"><a  onClick="getEvents(<?=$events['id_event']?>,<?=$events['id_type_event']?>); showDetail()"><i class="fas fa-circle"></i></a></td>
						          <? break; ?>
						        <? endswitch; ?>
						        </tr>
						    <? endforeach; ?>

						  </tbody>

						</table>

					</div>

				</div>

				<div id="event_detail_container" class="row mt-5 justify-content-center" style="display: none;">

				</div>


      		</div>
    	</div>
    </div>

</div>

<!-- Events created by user -->
<div class="card">
    <div class="card-header" id="headingMyEvents">

    	<h2 class="mb-0">

	        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseMyEventsStream" aria-expanded="true" aria-controls="collapseMyEvents">

	          Mis Eventos Creados <i class="fas fa-caret-down"></i>

	        </button>

    	</h2>

    </div>

    <div id="collapseMyEventsStream" class="collapse" aria-labelledby="headingMyEvents" data-parent="#accordionDashboard"  >

    	<div class="container">

      		<div  class="card-body">
				<div class="row">
      				<div class="col-md-10 offset-md-1 pl-0">
	        			<p class="font-weight-bold mb-0">Mis eventos creados</p>

						<p>Estos son tus eventos creados. Recuerda publicar o cancelar tus eventos.</p>
					</div>
				</div>


				<!-- Select Month Year -->

				<div class="row justify-content-center mt-5">

					<div class="col-md-5">

						<label class="font-weight-bold" for="monthEventsSelect">Mes</label>

						<select class="form-control form-custom-1" id="monthEventsSelect" onChange="changePublicEvents()">

							<? foreach($arrayMonths as $key => $months): ?>
               <? $selected = ($currentMonth == $key) ? "selected" : "" ?>
                	<option value="<?=$key?>" <?=$selected?>><?=$months?></option>
                <? unset($selected); ?>
              <? endforeach; ?>

						</select>

					</div>

					<div class="col-md-5">

						<label class="font-weight-bold" for="yearEventsSelect">Año</label>

						<select class="form-control form-custom-1" id="yearEventsSelect" onChange="changePublicEvents()">

							<? foreach($arrayYears as $years): ?>
                <? $selected = ($currentYear == $years) ? "selected" : "" ?>
                	<option value="<?=$years?>" <?=$selected?>><?=$years?></option>
                <? unset($selected); ?>
              <? endforeach; ?>

						</select>

					</div>

				</div>

				<!-- Inbox -->

				<div id="tablaeventosstream" class="row mt-5 justify-content-center">

					<div class="col-md-10 table-responsive">

						<table class="table">

						  <thead>

						    <tr>

						      <th scope="col">Fecha</th>

						      <th scope="col">Hora</th>

						      <th scope="col">Nombre</th>

						      <th scope="col"></th>
						      <th scope="col"></th>

						    </tr>

						  </thead>

						  <tbody id="public_listTableBody">

								<? foreach($arrayPublicEventsMerged as $publicEventsMerged): ?>
						     <? $time = date_create($publicEventsMerged['date_event']); ?>
								 <? $timeNow = date('Y-m-d H:i:s', time()); ?>
						        <tr>
						        <th scope="row"> <?getDayday($time);?> </th>
						        <td><?=DATE_FORMAT($time, 'H:i')?></td>
										<td><a  role="button" id="" class="a-evento status-dot-confirmed" onClick="getPublicEvents(<?=$publicEventsMerged['id_event']?>,<?=$publicEventsMerged['id_type_event']?>); showDetailPublic()"><?=($publicEventsMerged['id_type_event']=='4') ? '<i class="fas fa-wifi"></i>' : '<i class="fas fa-users"></i>'?> <?=$publicEventsMerged['name_event']?></a></td>
										<td><button  role="button" id="" class="btn btn-outline-secondary m-1" onClick="getPublicEvents(<?=$publicEventsMerged['id_event']?>,<?=$publicEventsMerged['id_type_event']?>); showDetailPublic()">Ver</button></td>
										<? switch($publicEventsMerged['active_event']): ?>
<? case "0": ?>
						          <td class="text-center btn-estadoevento row">
												<? if($publicEventsMerged['date_event']>$timeNow): ?>
													<button id="cancelEvent_<?=$publicEventsMerged['id_event']?>-<?=$publicEventsMerged['id_type_event']?>" onClick="cancelEventId(<?=$publicEventsMerged['id_event']?>, <?=$publicEventsMerged['id_type_event']?>)" data-toggle="modal" data-target="#cancelEventModal" class="btn btn-outline-secondary m-1 col-sm-12 col-md-5">Cancelar</button>
									      	<button id="publishEvent_<?=$publicEventsMerged['id_event']?>-<?=$publicEventsMerged['id_type_event']?>" onClick="publishEventId(<?=$publicEventsMerged['id_event']?>, <?=$publicEventsMerged['id_type_event']?>)" data-toggle="modal" data-target="#publishEventModal" class="btn btn-primary m-1 col-sm-12 col-md-5">Publicar</button>
												<? elseif($publicEventsMerged['date_event']<$timeNow): ?>
													<a class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Cancelar</a>
									      	<a class="btn btn-primary m-1 col-sm-12 col-md-5 isDisabled">Publicar</a>
												<? endif; ?>
											</td>
						          <? break; ?>
						          <? case "1": ?>
						          <td class="text-center btn-estadoevento row">
												<? if($publicEventsMerged['date_event']>$timeNow): ?>
													<button id="cancelEvent_<?=$publicEventsMerged['id_event']?>-<?=$publicEventsMerged['id_type_event']?>" onClick="cancelEventId(<?=$publicEventsMerged['id_event']?>, <?=$publicEventsMerged['id_type_event']?>)" data-toggle="modal" data-target="#cancelEventModal" class="btn btn-outline-secondary m-1 col-sm-12 col-md-5">Cancelar</button>
												<? elseif($publicEventsMerged['date_event']<$timeNow): ?>
													<a class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Cancelar</a>
												<? endif; ?>
												<button id="publishedEvent_<?=$publicEventsMerged['id_event']?>-<?=$publicEventsMerged['id_type_event']?>" class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Publicado</button>
											</td>
						          <? break; ?>
											<? case "2": ?>
							          <td class="text-center btn-estadoevento row">
							            <button class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Cancelado</button>
							          </td>
							        <? break; ?>
						        <? endswitch; ?>
						        </tr>
						    <? endforeach; ?>


						  </tbody>

						</table>

					</div>

				</div>
				<div id="detalleEventoStream" class="row mt-5 justify-content-center" style="display: none;">

				</div>
				<!-- <div class="row mt-1 d-flex d-sm-block">


					<div class="col-md-2 col-5 offset-md-1" id="statusDesc-reserved">

						<p class="font-weight-bold statusDesc-responsive">Reservado</p>

						<p class="status-desc">Tienes una reserva pendiente por confirmar o rechazar.</p>

					</div>

					<div class="col-md-2 col-5" id="statusDesc-pending">

						<p class="font-weight-bold statusDesc-responsive">Pendiente</p>

						<p class="status-desc">Pago pendiente por parte del cliente para confirmar el evento.</p>

					</div>

					<div class="col-md-2 col-5" id="statusDesc-confirmed">

						<p class="font-weight-bold statusDesc-responsive">Confirmado</p>

						<p class="status-desc">Servicio confirmado entre ambas partes.</p>

					</div>

					<div class="col-md-2 col-5" id="statusDesc-published">

						<p class="font-weight-bold statusDesc-responsive">Publicado</p>

						<p class="status-desc">Evento publicado en cartelera EchoMusic.</p>

					</div>

				</div> -->

      		</div>
    	</div>
    </div>

</div>


<!-- buy history by user -->
<div class="card">
    <div class="card-header" id="headingMyEvents">

    	<h2 class="mb-0">

	        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseMyHistory" aria-expanded="true" aria-controls="collapseMyEvents">

	          Mi Historial de Compras <i class="fas fa-caret-down"></i>

	        </button>

    	</h2>

    </div>

    <div id="collapseMyHistory" class="collapse" aria-labelledby="headingMyEvents" data-parent="#accordionDashboard"  >

    	<div class="container">

      		<div  class="card-body">
				<div class="row">
      				<div class="col-md-10 offset-md-1 pl-0">
	        			<p class="font-weight-bold mb-0">Mi historial de compras</p>

						<p>Desde aquí puedes descargar las entradas que hayas comprado.</p>
					</div>
				</div>


				<div id="tablaeventosstream" class="row mt-5 justify-content-center">

					<div class="col-md-10 table-responsive">

						<table class="table">

						  <thead>

						    <tr>

						      <th scope="col">Fecha transacción</th>

						      <th scope="col">Hora</th>

						      <th scope="col">Nombre</th>

						      <th scope="col"></th>

						    </tr>

						  </thead>

						  <tbody id="tickets_listTableBody">

								<? foreach($arraySubscribesPublic as $subscribesPublic): ?>
						     <? $time = date_create($subscribesPublic['date_transaction']); ?>
								 <? $timeNow = date('Y-m-d H:i:s', time()); ?>
						        <tr>
						        <td> <?getDayday($time);?> de <?getMonthYear($time)?></td>
						        <td><?=DATE_FORMAT($time, 'H:i')?></td>
										<td><p id="" class=""><i class="fas fa-users"></i> <?=$subscribesPublic['name_event']?></p></td>

						          <td class="text-center btn-estadoevento row">
									      	<a class="btn btn-primary m-1 col-sm-12 col-md-12" onClick="ticketsDownloadId('<?=$subscribesPublic['order_transaction']?>')" data-toggle="modal" data-target="#downloadTicketsModal">Descargar entradas</a>
											</td>

						        </tr>
						    <? endforeach; ?>

						  </tbody>

						</table>

					</div>

				</div>

      		</div>
    	</div>
    </div>

</div>



	<!-- Personal Data User -->

  <div class="card">

    <div class="card-header" id="headingMyInfo">

      <h2 class="mb-0">
      	<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseMyInfo" aria-expanded="true" aria-controls="collapseMyInfo">

          Mis Datos <i class="fas fa-caret-down"></i>

        </button>

      </h2>

    </div>

    <div id="collapseMyInfo" class="collapse" aria-labelledby="headingMyInfo" data-parent="#accordionDashboard"  >

      <div class="card-body">
      	<div class="container">

					<div class="row">

						<div class="col-md-8">

							<p class="font-weight-bold">Datos de Usuario</p>

							<p>Estos son los datos asociados a tu perfil de usuario.</p>

						</div>

						<div class="col-md-4 mt-2 text-right d-none d-sm-block">

							<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formPersonalData" aria-expanded="false" aria-controls="formPersonalData"><i class="fas fa-pen"></i> Editar</button>

						</div>

					</div>


				</div>

				<!-- Form Personal Info -->
				<div class="collapse" id="formPersonalData">

				<form action="" method="post">

				  <div class="form-row mt-2">

				    <div class="form-group col-lg-4">

				      <label class="font-weight-bold" for="inputEmail">Correo Electrónico</label>

				      <input type="email" name="email" class="form-control form-custom-1 isDisabled" readonly id="inputEmail" value="<?=$userProfile_array['mail_user']?>">

							<span class="text-danger"><strong class="alert"><?php if ( isset($emailError)) { echo $emailError;} ?></strong></span>

				    </div>

						<div class="form-group col-lg-4">

							<label class="font-weight-bold" for="inputRegion">Región</label>

							<select id="inputRegion" name="region" class="form-control form-custom-1" autcomplete="off" onChange="changeCities()">

								<? foreach($arrayRegions as $regions): ?>
									<? $selected = ($userProfile_array['id_region'] == $regions['id_region']) ? "selected" : "" ?>
											<option value="<?=$regions['id_region']?>" <?=$selected?>><?=$regions['name_region']?></option>
									<? unset($selected); ?>
								<? endforeach ?>

							</select>

							<span class="text-danger"><strong class="alert"><?php if ( isset($regionError)) { echo $regionError;} ?></strong></span>

						</div>

						<div class="form-group col-lg-4" id="div-cities">

							<label class="font-weight-bold" for="inputCity">Comuna</label>

							<select id="inputCity" name="comuna" class="form-control form-custom-1">

								<? foreach($arrayCities as $cities): ?>
									<? $selected = ($userProfile_array['id_city'] == $cities['id_city']) ? "selected" : "" ?>
												<option value="<?=$cities['id_city']?>" <?=$selected?>><?=$cities['name_city']?></option>
									<? unset($selected); ?>
								<? endforeach; ?>

							</select>

							<span class="text-danger"><strong class="alert"><?php if ( isset($comunaError)) { echo $comunaError;} ?></strong></span>

						</div>

				  </div>

				<div class="form-row mt-2">

					<div class="form-group col-lg-4">

			      <label class="font-weight-bold" for="inputAge">Edad</label>

			      <input type="text" name="age" class="form-control form-custom-1" id="inputAge" value="<?=$userProfileAgeValue?>">

						<span class="text-danger"><strong class="alert"><?php if ( isset($ageError)) { echo $ageError;} ?></strong></span>

			    </div>

					<div class="form-group col-lg-4" id="div-demo-genres">

						<label class="font-weight-bold" for="socGenre">Género</label>

						<select id="inputSocGenre" name="socGenre" class="form-control form-custom-1">
							<option value="0"> - </option>
							<? foreach($arraySocGenres as $socGenres): ?>
								<? $selected = ($userProfile_array['genre_data'] == $socGenres['id_soc_genre']) ? "selected" : "" ?>
											<option value="<?=$socGenres['id_soc_genre']?>" <?=$selected?>><?=$socGenres['soc_genre_name']?></option>
								<? unset($selected); ?>
							<? endforeach; ?>

						</select>

						<span class="text-danger"><strong class="alert"><?php if ( isset($socGenreError)) { echo $socGenreError;} ?></strong></span>

					</div>

				</div>

					<div class="text-rightcenter mt-3">

				  	<button type="submit" name="submitPersonalData_user" class="btn btn-primary btn-border">Guardar</button>

					</div>

				</form>
			</div>

				<div class="container">
					<div class="row mt-4">
						<div class="col-md-4"><span class="font-weight-bold">Nombre:</span> <?=ucfirst($userProfile_array['first_name_user'])?></div>
						<div class="col-md-4"><span class="font-weight-bold">Apellido:</span> <?=ucfirst($userProfile_array['last_name_user'])?></div>
						<div class="col-md-4"><span class="font-weight-bold">Correo:</span> <?=$userProfile_array['mail_user']?></div>
					</div>
					<div class="row mt-4">
						<div class="col-md-4"><span class="font-weight-bold">Región:</span> <?=(isset($userProfile_array['name_region'])) ? $userProfile_array['name_region'] : ""?></div>
						<div class="col-md-4"><span class="font-weight-bold">Comuna:</span> <?=(isset($userProfile_array['name_city'])) ? $userProfile_array['name_city'] : ""?></div>
						<div class="col-md-4"><span class="font-weight-bold">Género:</span> <?=(isset($userProfile_array['soc_genre_name'])) ? $userProfile_array['soc_genre_name'] : "" ?></div>
					</div>
					<div class="row mt-4">
						<div class="col-md-4"><span class="font-weight-bold">Edad:</span> <?=(isset($userProfile_array['age_data'])) ? $userProfile_array['age_data'] : ""?></div>
					</div>
				</div>

				<div class="row">

					<div class="col-md-4 mt-2 text-rightcenter d-block d-sm-none">

						<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formPersonalData" aria-expanded="false" aria-controls="formPersonalData"><i class="fas fa-pen"></i> Editar</button>

					</div>

				</div>

      </div>

    </div>

</div>

	<!-- Bank Data User -->

  <div class="card">

    <div class="card-header" id="headingMyData">

      <h2 class="mb-0">

        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseMyData" aria-expanded="false" aria-controls="collapseMyData">

          Mi Cuenta <i class="fas fa-caret-down"></i>

        </button>

      </h2>

    </div>

    <div id="collapseMyData" class="collapse" aria-labelledby="headingMyData" data-parent="#accordionDashboard" >

      <div class="card-body">

      	<div class="container">

				<div class="row">

					<div class="col-md-10">

						<? if($userProfile_array['data_ready'] == "yes"): ?>
			        <p class="font-weight-bold">Cuenta bancaria y domicilio tributario</p>
			        <p>Los datos serán utilizados para transferir los montos recaudados por concepto de venta de entradas, crowdfunding y contratación de servicios musicales mediante la plataforma. Por otra parte, la dirección será utilizada para la emisión del documento tributario (boleta o factura) según sea la modalidad tributaria del organizador o artista.</p>
			     <? elseif($userProfile_array['data_ready'] == "no"): ?>
			        <p class="font-weight-bold"> Registra tu Cuenta </p>
			        <p>Antes de publicar tu evento, necesitamos que registres los datos de tu cuenta para poder realizar los pagos por la venta de entradas.</p>
			      <? endif; ?>

					</div>

				<? if($userProfile_array['id_musician'] == 7): ?>
					<div class="col-md-10">

						<p class="font-weight-bold">Los Músicos Home Studio no pueden definir tarifas de pago para eventos.</p>

					</div>
				<? else: ?>
					<div class="col-md-2 mt-2 text-right d-none d-sm-block">

						<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formAccountData" aria-expanded="false" aria-controls="formAccountData"><i class="fas fa-pen"></i> Editar</button>

					</div>
				<? endif; ?>

				</div>
		</div>

	<? if($userProfile_array['id_musician'] != 7): ?>

		<div class="collapse" id="formAccountData">

			<form action="" method="post">

				<div class="form-row mt-3">

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputFname">Nombre</label>

						<input type="text" class="form-control form-custom-1" name="fname" id="inputFname" value="<?php if ( isset($fname)) { echo $fname;} ?>" />

						<span class="text-danger"><strong class="alert"><? if ( isset($fnameError)) { echo $fnameError;} ?></strong></span>

					</div>

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputLname">Apellido</label>

						<input type="text" name="lname" class="form-control form-custom-1" id="inputLname" value="<?php if ( isset($lname)) { echo $lname;} ?>">

						<span class="text-danger"><strong class="alert"><? if ( isset($lnameError)) { echo $lnameError;} ?></strong></span>

					</div>

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputRut">RUT</label>

						<input type="text" class="form-control form-custom-1" name="rut" value="<?php if ( isset($rut)) { echo $rut;} ?>" placeholder="sin puntos ni guión" id="inputRut" maxlength="12"/>

						<span class="text-danger"><strong class="alert"><? if ( isset($rutError)) { echo $rutError;} ?></strong></span>

					</div>

				</div>

				<div class="form-row mt-2">

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputBank">Banco</label>

						<select name="bank" id="inputBank" class="form-control form-custom-1">

							<option disabled selected value> - </option>

							<? foreach($arrayBanks as $banks): ?>
                	<option value="<?=$banks['id_bank']?>"><?=$banks['name_bank']?></option>';
              <? endforeach; ?>

						</select>

						<span class="text-danger"><strong class="alert"><? if ( isset($bankError)) { echo $bankError;} ?> </strong></span>

					</div>

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputTypeAccount">Tipo de Cuenta</label>

						<select name="tcuenta" id="inputTypeAccount" class="form-control form-custom-1">

							<option disabled selected value> - </option>

							<? foreach($arrayAccounts as $accounts): ?>
                	<option value="<?=$accounts['id_type_account']?>"><?=$accounts['name_type_account']?></option>
              <? endforeach; ?>

						</select>

						<span class="text-danger"><strong class="alert"><? if ( isset($tcuentaError)) { echo $tcuentaError;} ?></strong></span>

					</div>

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputNcuenta">Número de Cuenta</label>

						<input type="text" placeholder="sin puntos ni guiones" name="ncuenta" id="inputNcuenta" class="form-control form-custom-1" value="" />

						<span class="text-danger"><strong class="alert"><? if ( isset($ncuentaError)) { echo $ncuentaError;} ?></strong></span>

					</div>

				</div>

				<div class="form-row mt-2">

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputBankEmail">Correo asociado a la cuenta</label>

						<input type="email" class="form-control form-custom-1" name="bank_email" id="inputBankEmail" value="<?php if ( isset($email)) { echo $email;} ?>" />

						<span class="text-danger"><strong class="alert"><? if ( isset($bankEmailError)) { echo $bankEmailError;} ?></strong></span>

					</div>

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputPhone">Teléfono</label>

						<input placeholder="991234567" type="text" name="phone" id="inputPhone" class="form-control form-custom-1" value="(+56) 9<?php if ( isset($phone)) { echo $phone;} ?>" />

						<span class="text-danger"><strong class="alert"><? if ( isset($phoneError)) { echo $phoneError;} ?></strong></span>

					</div>

					<div class="form-group col-lg-4">

						<label class="font-weight-bold" for="inputDirection">Domicilio tributario</label>

						<input placeholder="" type="text" name="direction" id="inputDirection" class="form-control form-custom-1" value="<?php if ( isset($direction)) { echo $direction;} ?>" />

						<span class="text-danger"><strong class="alert"><? if ( isset($directionError)) { echo $directionError;} ?></strong></span>

					</div>

				</div>

				<div class="text-rightcenter mt-3">

				<? if($userProfile_array['data_ready'] == "yes"): ?>

					<button type="submit" name="accountUpdate" class="btn btn-primary btn-border">Guardar</button>

				<? else: ?>

					<button type="submit" name="accountSubmit" class="btn btn-primary btn-border">Guardar</button>

				<? endif; ?>
				</div>

			</form>

		</div>

	<? if($userProfile_array['data_ready'] == "yes"): ?>
    <div class="container">

			<div class="row mt-4">
				<div class="col-md-4"><span class="font-weight-bold">Nombre:</span> <?=ucfirst($userData_array['fname'])?></div>
				<div class="col-md-4"><span class="font-weight-bold">Apellido:</span> <?=ucfirst($userData_array['lname'])?></div>
				<div class="col-md-4"><span class="font-weight-bold">RUT:</span> <?=$userData_array['rut']?></div>
			</div>
			<div class="row mt-4">
				<div class="col-md-4"><span class="font-weight-bold">Banco:</span> <?=$userData_array['name_bank']?></div>
				<div class="col-md-4"><span class="font-weight-bold">Tipo de Cuenta:</span> <?=$userData_array['name_type_account']?></div>
				<div class="col-md-4"><span class="font-weight-bold">Número de Cuenta:</span> <?=$userData_array['ncuenta']?></div>
			</div>
			<div class="row mt-4">
				<div class="col-md-4"><span class="font-weight-bold">Correo:</span> <?=$userData_array['mail']?></div>
				<div class="col-md-4"><span class="font-weight-bold">Teléfono:</span> <?=$userData_array['phone']?></div>
				<div class="col-md-4"><span class="font-weight-bold">Domicilio tributario:</span> <?=$userData_array['direction']?></div>
			</div>

		</div>
	<? endif; ?>

			<div class="row">

				<div class="col-md-4 mt-2 text-rightcenter d-block d-sm-none">

					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formAccountData" aria-expanded="false" aria-controls="formAccountData"><i class="fas fa-pen"></i> Editar</button>

				</div>

			</div>

		<? endif; ?>

    </div>

    </div>

  </div>

	<!-- Interests User -->

  <div class="card">

    <div class="card-header" id="headingMyInterests">

      <h2 class="mb-0">

        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseMyInterests" aria-expanded="false" aria-controls="collapseMyInterests">

          Mis Gustos <i class="fas fa-caret-down"></i>

        </button>

      </h2>

    </div>

    <div id="collapseMyInterests" class="collapse" aria-labelledby="headingMyInterests" data-parent="#accordionDashboard" >

      <div class="card-body">

			<p class="font-weight-bold">Géneros que te gustan</p>

			<div class="row justify-content-center">

				<div class="col-md-8 text-center">

					<ul class="list-inline list-gustos" id="followedGenres_list">

						<? foreach($arrayGenresFollow as $genresFollow): ?>
								<li id="genre-follow-<?=$genresFollow['id_genre']?>" class="list-inline-item "><button type="button" class="btn btn-primary btn-lg btn-border my-2"><?=$genresFollow['name_genre']?> <i class="fas fa-times ml-5" onClick="unfollowGenre(<?=$genresFollow['id_genre']?>)"></i></button></li>
						<? endforeach; ?>

					</ul>

				</div>

			</div>

			<!-- <form action="" method="post"> -->

				<div class="form-row align-items-center mb-5 justify-content-center">

					<div id="drop-gustos" class="col-md-6 mt-2">

						<select name="genreFollow" id="inputFollowGenre" class="selectpicker form-control" data-live-search="true" title="Buscar Género">

						  <? foreach($arrayGenres as $genres): ?>
                	<option data-token="<?=$genres['name_genre']?>" value="<?=$genres['id_genre']?>"><?=$genres['name_genre']?></option>
              <? endforeach; ?>

						</select>

      		</div>

					<div class="col-md-2 mt-2">

	      		<button type="submit" name="save_likes" onClick="genreFollow()" class="btn btn-outline-secondary text-orange mb-2 btn-block">Agregar</button>

		    	</div>

				</div>

			<!-- </form> -->

			<hr>
			<p class="font-weight-bold">Artistas que sigo</p>
			<div id="artistasInteres" class="row">

				<? if(!empty($arrayArtistsFollow)): ?>
					<? foreach($arrayArtistsFollow as $artistsFollow): ?>
						<div id="artist-follow-<?=$artistsFollow['id_user']?>" class="col-md-3 text-center mt-4 memberBand">

							<a href="profile.php?userid=<?=$artistsFollow['id_user']?>"><img src="images/avatars/<?=$artistsFollow['id_user']?>.jpg" class="card-img-top memberAvatar m-auto" alt="..."></a>

							<div class="card-body">

								<p class="font-weight-bold"><?=$artistsFollow['nick_user']?></p>


								<button onClick="unfollowArtistDashboard(<?=$artistsFollow['id_user']?>)"  id="artista1" type="button" class="btn btn-primary" >Dejar de seguir</button>
								<div id="popover-content-artista1" class="popover popover-artistas hidden">
									<div  class=" popover-artistas">
										<ul class="list-btnpop">
											<!-- <li><a href="#"><i class="fas fa-user-lock"></i> Bloquear Usuario</a></li> -->
											<li><a onClick="unfollowArtistDashboard(<?=$artistsFollow['id_user']?>)"><i class="far fa-window-close"></i> Dejar de Seguir</a></li>
										</ul>
									</div>
								</div>

							</div>

						</div>
					<? endforeach; ?>
				<? else: ?>
					<p>Aún no sigues a ningún Artista.</p>
				<? endif; ?>

			</div>

      </div>

    </div>

  </div>



	<!-- Contact Support User -->

  <div class="card">

    <div class="card-header" id="headingMySupport">

      <h2 class="mb-0">

        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseMySupport" aria-expanded="false" aria-controls="collapseMySupport">

          Soporte <i class="fas fa-caret-down"></i>

        </button>

      </h2>

    </div>

    <div id="collapseMySupport" class="collapse <?=($openContact === true) ? "show" : ""?>" aria-labelledby="headingMySupport" data-parent="#accordionDashboard" >

      <div class="card-body">

				<p class="font-weight-bold">Formulario de Contacto</p>

				<p>Si necesitas ayuda o tienes alguna duda sobre nuestro servicio, no dudes en ponerte en contacto con nosotros.</p>

			<? if($contactAdmin == false): ?>
				<form action="#headingMySupport" method="post" autocomplete="off">

					<div class="form-row mt-3">

						<div class="form-group col-md-8">

							<label class="font-weight-bold" for="inputContactSubject">Asunto</label>

							<input type="text" class="form-control form-custom-1" name="subject" value="<?php if ( isset($subject_request)) { echo $subject_request;} ?>" id="inputContactSubject">

							<span class="text-danger"><? if ( isset($subjectError)) { echo $subjectError;} ?></span>

						</div>

					</div>

					<div class="form-row mt-3">

						<div class="form-group col-md-8">

							<label class="font-weight-bold" for="inputContactMessage">Mensaje</label>

							<textarea class="form-control form-custom-1" name="description_text" id="inputContactMessage" rows="6"><?if(isset($desc_request)){ echo str_replace("\'","'",$desc_request);  }?></textarea>

							<span class="text-danger"><? if ( isset($descError)) { echo $descError;} ?></span>

						</div>

					</div>

					<div class="form-row mt-3">

						<button type="submit" name="submit_contact" class="btn btn-primary px-5 py-2 btn-border">Enviar</button>

					</div>

				</form>
			<? elseif($contactAdmin == true): ?>

				<h3 class="font-weight-bold">El número de tu solicitud es el Nº<?=$assistNumber?>, nos pondremos en contacto contigo lo antes posible.</h3>

			<? endif; ?>

      </div>

    </div>

  </div>



</div>
