<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Yeon+Sung&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo element('view_skin_url', $layout); ?>/css/main.css"/>

<?php
$time_table = element('calendar', $view);
$day = 1;
$n_day = 0;
?>
<div class="content">
	<div class="li" id="main1">
		<div class="calendar">
			<p><?= element('month', $time_table) ?>월 <?= element('day', $time_table) ?>일</p>
			<table>
				<thead>
				<tr>
					<td>일</td>
					<td>월</td>
					<td>화</td>
					<td>수</td>
					<td>목</td>
					<td>금</td>
					<td>토</td>
				</tr>
				</thead>
				<tbody>
				<?php for ($i = 1; $i <= element('total_week', $time_table); $i++) { ?>
					<tr>
						<?php for ($j = 0; $j < 7; $j++) { ?>
							<td class="<?=$day == element('day', $time_table)?' click_date':''?>">
								<!-- 날짜 출력 -->
								<?php if (!(($i == 1 && $j < element('start_week', $time_table)) || ($i == element('total_week', $time_table) && $j > element('last_week', $time_table)))) { ?>
									<span class="date"><?= $day < 10 ? "0" . $day : $day ?></span>
									<?php if ($day == element('day', $time_table)) { ?>
										<img src="<?= base_url('uploads/sample/highlight.png') ?>">
									<?php }
									$day++;
									if ($i == element('total_week', $time_table) && $j == element('last_week', $time_table)) {
										$day = 1;
									}
								} ?>
							</td>
						<?php } ?>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="li" id="main2">
		<p class="title">따스한 5월,</p>
		<p class="sub_title">저희의 시작에 함께해주세요.</p>
		<p class="date_title">2021년 5월 15일 토요일  오전 11시 30분</p>

		<img src="<?=base_url('uploads/sample/illust.png')?>"/>
		<label class="left">
			<span>신랑</span>
			<span>민식</span>
		</label>
		<label class="right">
			<span>신부</span>
			<span>아랑</span>
		</label>
	</div>
	<div class="li" id="main3">
		<p>info</p>
	</div>
	<div class="li" id="main4">
		<p>comment</p>
	</div>
</div>

<script type="text/javascript">
	var total_section = 4; //전체 원페이지 수
	var current_idx = 0;

	var screen_h = $('.content').find('.li').height(); // 화면 높이
	var page_h = screen_h;
	var last_y = screen_h*total_section; // 스크롤 마지막 하단 높이

	var onpage_on = true;
	var isScroll = false;

	console.log(screen_h);
	console.log(last_y);

	$(document).ready(function(){

		//init();


		// Scroll Event
		$('html').on('scroll touchmove mousewheel', function(event) {

			//console.log(current_idx);
			console.log($("html").scrollTop());

			if(last_y > $(".content").scrollTop() && !onpage_on){

				//원페이지 스크롤 진입
				console.log(":: 원페이지 시작 ::");
				onpage_on = true;
				isScroll = false;
			}

			if(!onpage_on) return;

			//스크롤 이벤트 막기
			//event.preventDefault();
			event.stopPropagation();
			if(isScroll) return; // 현재 스크롤이 동작중이면 종료


			isScroll = true;
			var direction = event.originalEvent.wheelDelta; //마우스 휠 방향
			var y = 0;

			if(direction > 0){
				// up
				current_idx --;
				if(current_idx < 0){current_idx = -1;}
				y = current_idx * page_h;
			}
			else{
				// down
				current_idx ++;
				if(current_idx > total_section){
					current_idx = total_section;
					onpage_on = false;
					return;
				}

				y = current_idx * page_h;
			}

			$('.content').animate({scrollTop: y}, 500, function(){isScroll=false;});
		});

		$('.click_date').click(function(){
			$('.content').animate({scrollTop: $('#main2').position().top}, 500, function(){isScroll=false;});
		});
	});

	$( window ).resize(function() {

		// 반응형
		setHeight();
	});


	function init(){

		setHeight();

		total_section = $('.content .li').length;
		last_y = page_h * total_section;
	}

	function setHeight(){

		// 높이 설정
		screen_h = document.body.clientHeight;
		//page_h = screen_h - 80;
		$(".content .li").height(page_h);
	}

</script>
