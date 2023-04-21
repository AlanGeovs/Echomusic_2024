<div class="modal fade" id="ratingsModal" tabindex="-1" role="dialog" aria-labelledby="ratingsModalLabel" aria-hidden="true">

<div class="modal-dialog modal-xl">

  <div class="modal-content">

    <div class="modal-header">

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <span aria-hidden="true">&times;</span>

      </button>

    </div>

    <div class="modal-body">

      <div class="container-fluid">

        <div class="row">

  					<div class="col-md-4">
              <? if(file_exists('images/avatars/'.$userInfo_array['id_user'].'.jpg')): ?>
					      <img src="images/avatars/<?=$userInfo_array['id_user']?>.jpg" class="mr-4" id="ratingsArtistAvatar" alt="...">
              <? else: ?>
                <img src="images/avatars/profile_default.jpg" class="mr-4" id="ratingsArtistAvatar" alt="...">
              <? endif; ?>
            </div>
						<div class="col-md-8 text-leftcenter">

  							<h2 class="mt-0 mb-0"><?=$userInfo_array['nick_user']?></h2>

  							<i class="fas fa-star text-orange"></i><span class="font-weight-bold"><?=displayTotalRating($rateArray)?> </span><span class="font-weight-bold">(<?=count($rateArray)?> reseñas)</span>

                <div class="progress-container">

                  <span class="progress-label">5 <i class="fas fa-star"></i></span>

                  <div class="progress">

                    <div class="progress-bar" role="progressbar" style="width: <?=$rateN5?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                  </div>

                </div>

                <div class="progress-container">

                  <span class="progress-label">4 <i class="fas fa-star"></i></span>

                  <div class="progress">

                    <div class="progress-bar" role="progressbar" style="width: <?=$rateN4?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                  </div>

                </div>

                <div class="progress-container">

                  <span class="progress-label">3 <i class="fas fa-star"></i></span>

                  <div class="progress">

                    <div class="progress-bar" role="progressbar" style="width: <?=$rateN3?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>

                  </div>

                </div>

                <div class="progress-container">

                  <span class="progress-label">2 <i class="fas fa-star"></i></span>

                  <div class="progress">

                    <div class="progress-bar" role="progressbar" style="width: <?=$rateN2?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>

                  </div>

                </div>

                <div class="progress-container">

                  <span class="progress-label">1 <i class="fas fa-star"></i></span>

                  <div class="progress">

                    <div class="progress-bar" role="progressbar" style="width: <?=$rateN1?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>

                  </div>

                </div>

  						</div>

        </div>

        <div class="row mt-4 overflow-auto" id="commentRatingsModal">
	         <? foreach($rateArray9 as $ratingArray):?>
    					<div class="col-sm-12 col-md-6 col-lg-4 mb-3">

    						<div class="card pl-4 pr-4 pt-3">

    							<div class="media">

    								<? if(file_exists('images/avatars/'.$ratingArray['id_user'].'.jpg')): ?>
      								<img src="images/avatars/<?=$ratingArray['id_user']?>.jpg" class="commentAvatar mr-3 mt-1" alt="...">
      							<? else: ?>
      								<img src="images/avatars/profile_default.jpg" class="commentAvatar mr-3 mt-1" alt="...">
      							<? endif; ?>

    								<div class="media-body">

    									<h5 class="mt-0 mb-0"><?=ucfirst($ratingArray['first_name_user'])?> <?=ucfirst($ratingArray['last_name_user'])?></h5>

    									<span class="ratingDate"><?=$ratingArray['date_rating']?></span>

    								</div>

    							</div>

                  <div class="show-less-div mt-3">

      							<p class=""><?=$ratingArray['comment_rating']?></p>

      						</div>

    						</div>

    					</div>
            <? endforeach; ?>

  				</div>

      </div>

    </div>

    <div class="modal-footer text-center">



    </div>

  </div>

</div>

</div>
