<?
$m_idx = $_SESSION['LOGGED_INFO'];
?>
<style media="screen">
.faq_article_m {
  display: block;
  border: 1px solid #eee;

}
ul{
  padding: 0;
  list-style: none;
}
.faq_article > li{
  display: block;
  width: 100%;
  text-align: left;
}
.commerce {
  display: none;
}
.member {
  display: block;
}
.faq_p{
  display:inline-block;
  padding: 10px 5px;
  font-size: 16px;
  font-weight: 600;
}
.q{
  overflow: hidden;
  font-size: 15px;
  font-weight: 700;
  border-top: 0;
  padding-left: 70px;
  height: 60px;
  display: block;
  height: 59px;
  line-height: 59px;
  background-color: #ffffff;
  border-top: 1px solid #efefef;
  padding-left: 45px;
}
.a{

}
.Q_S{

}
.q > a {
  display: block;
  position: relative;
}
@media screen and (min-width: 673px) {

}
.q ::after {
  background: none;
  border-bottom: 1px solid #999;
  border-right: 1px solid #999;
  transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  width: 5px;
  position: absolute;
  height: 5px;
  content: '';
  display: inline-block;
  top: 26px;
  right: 40px;
  transition: all 0.3s ease-out;
}
.on.changed ::after{
  transform: rotate(225deg);
  -ms-transform: rotate(225deg);
}
@media screen and (min-width: 673px) {

  .faq_container ul.faq_article .on .a {
    overflow: hidden;
    background-color: #fffcf9;
    padding: 0px 100px;
    box-sizing: border-box;
    height: 0px;
    font-size: 14px;
    line-height: 24px;
    color: #333;
    position: relative;
    transition: all 0.4s ease-out;
    background: #fbfbfb;
  }
  .faq_container ul.faq_article .changed .a {
    padding: 50px 100px;
    height: auto;
    transition: all 0.4s ease-out;
    border-top: 1px solid #c1c1c1;
  }
  .q ::before {
    content: "Q";position: relative;color: #444;margin-right: 55px;font-size: 15px;
  }
}
@media screen and (max-width: 672px) {

  .faq_container ul.faq_article .on .a {
    overflow: hidden;
    background-color: #fffcf9;
    padding: 0px 50px;
    box-sizing: border-box;
    height: 0px;
    font-size: 14px;
    line-height: 24px;
    color: #333;
    position: relative;
    transition: all 0.4s ease-out;
    background: #fbfbfb;
  }
  .faq_container ul.faq_article .changed .a {
    padding: 20px 50px;
    height: auto;
    transition: all 0.4s ease-out;
    border-top: 1px solid #c1c1c1;
  }
}
.body_content{
  padding-bottom: 150px;
}

</style>
<link rel="stylesheet" href="/layout/company/assets/default.css">

<section class="bg-white">
    <div class="p-3 mt-4 pt-5 d-lg-none">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">자주묻는 질문</h5>
    </div>

    <div class="body_content align_center">
		<section class="max_width margin_auto inline_block width_100">
			<div class="visible-md visible-lg">
					<img src="https://wimirgsjsoop.cdn3.cafe24.com/main/faq_1.png" style="width:70%; padding:40px 70px" alt="">
			</div>
			<div class="visible-sm visible-xs">
					<img src="https://wimirgsjsoop.cdn3.cafe24.com/main/faq_1_m.png" style="width:100%; padding:20px 15px" alt="">
			</div>
		</section>
		<section class="max_width margin_auto inline_block width_100">
			<? if($m_idx > 0) { ?>
				<a href="<?=getUrl('contact')?>">
					<div class="visible-md visible-lg">
						<img src="https://wimirgsjsoop.cdn3.cafe24.com/main/faq_2.png" style="width:90%" alt="">
					</div>
					<div class="visible-sm visible-xs">
						<img src="https://wimirgsjsoop.cdn3.cafe24.com/main/faq_2_m.png" style="width: 100%;" alt="">
					</div>
				</a>
			<? }else{ ?>
				<a onclick="login_show()" style="cursor:pointer">
					<div class="visible-md visible-lg">
						<img src="https://wimirgsjsoop.cdn3.cafe24.com/main/faq_2.png" style="width:90%" alt="">
					</div>
					<div class="visible-sm visible-xs">
						<img src="https://wimirgsjsoop.cdn3.cafe24.com/main/faq_2_m.png" style="width: 100%;" alt="">
					</div>
				</a>
			<? } ?>


		</section>
		<section class="max_width margin_auto inline_block width_100">
			<div style="padding : 50px 0px">
				<a onclick="checking(1)" style="cursor:pointer;margin-right: 20px;">	<img id="check_m" src="/oPage/contact/images/check_o.png" style="width:20px" alt=""><p id="mem" class="faq_p" style="color:black">개인회원</p> </a>
				<a onclick="checking(2)" style="cursor:pointer"> <img id="check_c" src="/oPage/contact/images/check_x.png" style="width:20px" alt=""><p id="com" class="faq_p" style="color:#b3b2b3">기업회원</p> </a>
			</div>

		</section>
		<section class="max_width margin_auto inline_block width_100 padding_top_50_xs_null padding_bottom_50">
			<div class="faq_text_container mot4 active" style="display: block;">
			        <div class="faq_container">
			            <!--<ul class="faq_tab">-->
			                <!--<li class="on"><a><span class="en">About LIFEPLUS</span></a></li>-->
			                <!--<li><a href="javascript:;"><span class="en">벚꽃피크닉 2019</span></a></li>-->
			            <!--</ul>-->

			            <ul class="faq_article member">
											<li class="on">
			                    <p class="q"><a>회원가입과 이력서등록은 무료인가요?</a></p>
													<p class="a">
                        	기술자숲 개인 회원가입 및 일반이력서 등록은 별도의 비용없이 무료로 가능합니다.<br>
													<br>&nbsp;단, 프리미엄이력서의 경우 프리미엄회원 결제가 필요하며<br>
													<span style="font-weight:600">[메뉴]-[기술자숲 소개]-[이용요금]</span> 페이지에서 자세한 내용을 확인해주세요.
                    			</p>
			                </li>
			                <li class="on">
			                    <p class="q"><a>이력서를 수정하려고 합니다. 어떻게 하나요?</a></p>
			                    <p class="a">
														<span style="line-height: 30px;">
														&nbsp;1단계.&nbsp;로그인 후 메인화면에서 나의 이력서 완성도를 확인하고 <br>
                            [이력서 수정하기] 버튼을 누르시면 수정 페이지로 이동이 가능합니다.<br>
														&nbsp;2단계.&nbsp;로그인 후 [메뉴]-[이력서 등록] 으로 연결하여 내 이력서 관리에서 수정하기 버튼을 누르시면 됩니다.<br>
														&nbsp;3단계.&nbsp;이력서를 수정하고 저장버튼을 누르면 이력서가 수정됩니다.<br>
														<br>
														</span>
														*입사지원 이후 이력서를 수정할 시 수정내용이 즉시 반영되며 지원했던 이력서도 함께 수정됩니다.
			                    </p>
			                </li>
			                <!-- <li class="on d-none">
			                    <p class="q"><a>종이이력서 온라인변환서비스(=사진이력서)가 뭔가요? (+등록방법 및 등록소요시간)</a></p>
			                    <p class="a">
														종이이력서 온라인변환서비스(=사진이력서)란 온라인이력서 등록을 위해 이력사항을 일일이 기재하기 어려운분들을 위한 서비스입니다.<br>
														작성해 놓으신 종이이력서를 사진으로 찍어서 등록하시거나 이력서파일(docx,hwp,xlsx,jpg,png등)로 등록하시면<br>
														기술자숲에서 온라인이력서로 대신 변환해드리며,<br>
														변환된 온라인이력서를 통해 기술자숲에서 원하는 기업에 지원하실 수 있습니다.<br>
														<br>
														기술자숲 회원이라면 누구나 이용할 수 있는 서비스이며, 온라인 이용에 어려움이 있는 분에게 추천드립니다.<br>
														<br>
														<span style="line-height: 30px;">
														1) 이용방법 :<br>
														&nbsp;1단계.&nbsp;자필로 작성 또는 인쇄된 종이이력서 사진이나 이력서파일(docx,hwp,xlsx,jpg,png등)을 준비해주세요.<br>
														&nbsp;2단계.&nbsp;로그인 후 [메뉴]-[이력서등록]으로 들어가 이력서 [수정하기]를 눌러주세요.<br>
														&nbsp;3단계.&nbsp;페이지 상단에 있는 [이력서 파일 등록하기] 버튼을 클릭해주세요. <br>
														&nbsp;4단계.&nbsp;첨부파일 등록 창이 뜨면 찍어둔 종이이력서나 이력서파일(docx,hwp,xlsx,jpg,png등)을 파일로 첨부해주세요.<br>
															<br>
														2) 소요시간 : 사진으로 첨부해주신 종이이력서는 기술자숲에서 검토 후 최종 업로드 되며<br>
														&nbsp;	최종 업로드까지 평균 24시간이 소요됩니다. (주말 제외)
														</span>
			                    </p>
			                </li> -->
											<li class="on">
			                    <p class="q"><a>종이이력서 변환 서비스(=사진이력서)가 뭔가요?</a></p>
			                    <p class="a">
														종이이력서 온라인변환서비스(=사진이력서)란 온라인이력서 등록을 위해 이력사항을 일일이 기재하기 어려운분들을 위한 서비스입니다.<br>
														작성해 놓으신 종이이력서를 사진으로 찍어서 등록하시거나 이력서파일(docx,hwp,xlsx,jpg,png등)로 등록하시면<br>
														기술자숲에서 온라인이력서로 대신 변환해드리며,<br>
														변환된 온라인이력서를 통해 기술자숲에서 원하는 기업에 지원하실 수 있습니다.<br>
														<br>
														기술자숲 회원이라면 누구나 이용할 수 있는 서비스이며, 온라인 이용에 어려움이 있는 분에게 추천드립니다.<br>
			                    </p>
			                </li>
											<li class="on">
			                    <p class="q"><a>종이이력서 변환 서비스의 등록방법은 뭔가요?</a></p>
			                    <p class="a">
														<span style="line-height: 30px;">
														등록방법 :<br>
                            &nbsp;1단계.&nbsp;자필로 작성 또는 인쇄된 종이이력서 사진이나 이력서파일(docx,hwp,xlsx,jpg,png등)을 준비해주세요.<br>
														&nbsp;2단계.&nbsp;로그인 후 [메뉴]-[이력서등록]으로 들어가 이력서 [수정하기]를 눌러주세요.<br>
														&nbsp;3단계.&nbsp;페이지 상단에 있는 [이력서 파일 등록하기] 버튼을 클릭해주세요. <br>
														&nbsp;4단계.&nbsp;첨부파일 등록 창이 뜨면 찍어둔 종이이력서나 이력서파일(docx,hwp,xlsx,jpg,png등)을 파일로 첨부해주세요.<br>
														2) 소요시간 : 사진으로 첨부해주신 종이이력서는 기술자숲에서 검토 후 최종 업로드 되며<br>
														&nbsp;	최종 업로드까지 평균 24시간이 소요됩니다. (주말 제외)
														</span>
			                    </p>
			                </li>
											<li class="on">
			                    <p class="q"><a>종이이력서 변환 서비스는 얼마나 걸리나요?</a></p>
			                    <p class="a">
														소요시간 : 사진으로 첨부해주신 종이이력서는 기술자숲에서 검토 후 최종 업로드 되며<br>
														&nbsp;	최종 업로드까지 평균 24시간이 소요됩니다. (주말 제외)
			                    </p>
			                </li>
			                <li class="on">
			                    <!-- <p class="q d-none"><a>이력서 등록 후 공고에 지원했는데 왜 아무 연락이 없나요?</a></p> -->
													<p class="q"><a>공고에 지원했는데 왜 아무 연락이 없나요?</a></p>
			                    <p class="a">
														등록해주신 이력서는 지원하신 기업에 전달되고 채용담당자가 지원자의 이력정보를 열람한 후 면접의사 있으면 해당기업에서 지원자에게 연락을 하게 됩니다.<br><br>
                            본인의 이력서가 회사에서 원하는 직무와 적합도가 낮은 경우 기업에서 면접제안을 하지 않을 가능성이 높기 때문에,<br>
                            본인의 이력서가 지원한 회사의 직무에 맞는지 다시 확인 후에 지원해보시길 바랍니다.
														<!-- 기업측의 이력서 확인 여부는 [일자리찾기]페이지의 [입사지원현황]에서 확인하실 수 있으며 만약 [미열람]으로 표시된 경우 다음과 같은 사유가 있을 수 있있습니다.<br><br>
														&nbsp;[미열람일 경우] <br>
														&nbsp;	- 이미 채용을 완료하여 모집을 마감했을 경우 추가검토를 하지 않음
														&nbsp;	- 기업의 구인 조건에 따라 선택적 열람
														&nbsp;	- 채용공고 기간 마감 이후 일괄검토
														&nbsp;	- 기타 사유 -->
			                    </p>
			                </li>

			                <li class="on">
			                    <p class="q"><a>일자리정보를 확인하려면 어떻게 하면 되나요?</a></p>
			                    <p class="a">
                            로그인 후 [메뉴]-[일자리찾기]로 이동하여 일자리정보 [더보기]클릭시 기술자숲에 등록되어 있는 공고가 표시 됩니다.<br>
                            [맞춤공고]는 나에게 맞는 일자리 정보를 보여드리며, [전체공고]에서는 내가 원하는 직무 지역 등을 선택하여 일자리 정보를 확인할 수 있습니다.
														<!-- 1단계.&nbsp; 로그인 후 기술자숲 첫 화면의 메뉴바에 있는 [일자리찾기]를 클릭해주세요.<br>
														2단계.<br>
														&nbsp;&nbsp;<span style="font-weight:600"><기술자숲 회원일 경우></span><br>
														&nbsp;&nbsp;&nbsp;기술자숲 스마트 매칭시스템을 통해 회원님의 이력서에 기입 되어있는 직종을 분석, 회원님의 경력에 맞는 맞춤일자리가 보여집니다.<br><br>
														&nbsp;&nbsp;<span style="font-weight:600"><기술자숲 회원이 아닐 경우></span><br>
														&nbsp;&nbsp;&nbsp;기술자숲에 게재된 전체공고 중 일부공고가 보여집니다. -->
			                    </p>
			                </li>

			                <li class="on">
			                    <!-- <p class="q d-none"><a>인기채용공고 이메일 구독서비스를 신청하고 싶은데 수신설정은 어떻게 하나요?</a></p> -->
													<p class="q"><a>인기공고 구독서비스를 신청하려면 어떻게 하나요?</a></p>
			                    <p class="a">
													지역별 인기채용공고 이메일 구독서비스는 기술자숲 회원이라면 누구나 무료로 받아 볼 수 있습니다.(주1회)<br>
													이메일은 회원가입시 기재해주신 정보로 발송되며, 만약 기술자숲 회원가입을 했음에도 메일을 수신하지 못하신 경우에는 아래 사항을 확인해보시기 바랍니다.<br><br>
													[이메일 미수신]<br><span style="line-height: 30px;">
													&nbsp;1)회원가입 시 이메일 미기재<br>
													&nbsp;2)이메일 주소상의 오류 (잘못 기재했을 경우)<br>
													&nbsp;3)스팸으로 처리됨<br>
													&nbsp;4)이메일 발송 내부 시스템 오류<br>
													&nbsp;5)회원가입시 기재한 이메일 주소를 이메일주소를 변경했을 때</span><br>
													<br>
													&nbsp;1), 2)와 같은 사유로 이메일 수신을 못한 경우  <br>
													&nbsp;&nbsp;<strong>[메뉴]-[내정보관리]-[내정보설정]</strong>에 들어가 이메일 정보를 변경하여 주시기 바랍니다.<br>
													&nbsp;4), 5)와 같은 사유로 이메일 수신이 안된 경우 기술자숲으로 유선문의 주시길 바랍니다<br>
													문의전화 : 1800-9665
			                    </p>
			                </li>

                      <li class="on">
			                    <p class="q"><a>제가 원하는 알림만 받고싶어요.</a></p>
			                    <p class="a">
                            기술자숲에서 제공하는 알림 중 본인이 원하는 알림만 제한적으로 설정하고 싶으신 분들은<br>
                            [메뉴]-[내정보관리]-[알림설정] 혹은 우측상단의 종모양을 클릭하여 알림센터에서 우측상단의 설정을 클릭하여 들어간 후,<br>
                            나에게 필요한 알림과 제한할 알림을 수정해주시면 됩니다.<br>
                            만약 다시 알림을 받기 원하신다면 똑같은 방법으로 접속하여 수정하여 주시면 됩니다.
			                    </p>
			                </li>

                      <li class="on">
                          <p class="q"><a>이력서 완성도가 낮음으로 나오는데 어떻게 하면 높일 수 있나요?.</a></p>
                          <p class="a">
                            이력서 완성도는 말 그대로 본인이 작성한 이력서의 완성도를 나타냅니다.<br>
                            기본적인 정보 학교 기본사항 등을 모두 작성 해 주시고,<br>
                            본인의 경력 사항 등 빈칸없이 빠짐없이 적을수록 본인의 이력서 완성도가 높아집니다.<br>
                            상대적으로 이력서 정보를 부실하게 적는 경우에는 이력서 완성도가 낮게 나올 수밖에 없습니다.
                          </p>
                      </li>

			                <!-- <li class="on">
			                    <p class="q d-none"><a>채용 2배상승, ‘프리미엄회원’과 일반회원의 차이는 무엇인가요?</a></p>
													<p class="q d-md-none"><a>‘프리미엄회원’과 일반회원의 차이는 무엇인가요?</a></p>
			                    <p class="a">
														기술자숲의 ‘프리미엄회원’ 서비스는<br>
														 [프리미엄 이력서 제작] [24시간 공고우선열람권] 등으로 면접, 채용의 가능성을 높여주는 한층 업그레이드 된 기술자관리 서비스입니다.<br><br>
														나에게 딱 맞는 공고를 남들보다 먼저 열람하고,<br>
														기업에게 우선노출되는 [기술자숲 프리미엄이력서]로 더 쉽고 빠르게 원하는 기업에 입사해보세요.<br><br>
 일반회원과 프리미엄회원의 자세한 혜택 내용은 아래 페이지에서 확인해주시기 바랍니다. <br>
														<a href="./premium.html"><span style="color:#003e6f;font-weight:700"> 일반회원과 프리미엄회원 혜택 자세히보기(클릭)</span></a>
			                    </p>
			                </li> -->
			            </ul>

									<!-- commerce -->
									<ul class="faq_article commerce">
											<li class="on">
			                    <p class="q"><a>기업회원 가입과 채용공고 등록은 무료인가요?</a></p>
													<p class="a">
                            기술자숲 기업 회원가입은 별도의 비용없이 무료로 가능합니다.<br>
                            채용공고등록은 기존의 신문광고와는 다르게 지원자가 발생할지 안할지 불확실한 상황에서 선불로 지급하는<br>
                            방법이 아닌 후불제로 진행되며 적합지원자 발생시에만 공고등록비를 지불하시면 됩니다.<br>
                            기간에 관계없이(1개월) 공고 등록비는 98,000원(VAT포함)으로 동일하며, <br>
                            적합지원자 AI 선별 및 맞춤 기술자 추천까지 받아 볼 수 있습니다.
                    			</p>
			                </li>
			                <li class="on">
			                    <p class="q"><a>등록한 공고의 수정/마감은 어떻게 하면 되나요?</a></p>
			                    <p class="a">
													1)공고 수정하기<br><br>
													<span style="line-height: 30px;">
  													&nbsp;1단계.&nbsp; 로그인 후 기술자숲 메인화면에서 내가 등록한 공고를 확인하고 수정 버튼을 누르면 수정페이지로 이동됩니다.<br>
    												&nbsp;2단계.&nbsp; [메뉴]-[공고‧지원자관리]로 접속하여 진행중인 공고에서 수정 버튼을 누르시면 됩니다.<br>
                          </span>
													<br>
													2)공고 마감하기 <br><br>
													<span style="line-height: 30px;">
                            기본적으로 내가 설정해 둔 공고의 마감일이 되면 자동으로 마감이 됩니다.<br>
                            기간 종료 이전에 마감을 원한다면, [메뉴]-[공고‧지원자관리] 페이지에서 <br>
                            현재 진행중인 공고 중 마감 할 공고에서 [공고마감하기]버튼을 누르면 마감이 됩니다.
													<!-- &nbsp;1단계.&nbsp; 로그인 후 기술자숲 첫 화면의 메뉴바에 있는 [지원자관리]를 클릭해주세요.
													&nbsp;2단계.&nbsp; [지원자관리] 페이지 내 진행중인 공고에서 [상세보기] 버튼을 눌러주세요.
													&nbsp;3단계.&nbsp; 상세보기페이지의 가장 하단에 있는 [일자리정보수정] 버튼을 누르신 후 공고종료기간을 금일 날짜로 설정해주세요. -->
                        </span>

			                    </p>
			                </li>
			                <li class="on">
			                    <p class="q"><a>회원탈퇴는 어떻게 하나요?</a></p>
			                    <p class="a">
														회원 탈퇴를 하시게 되면 회원님께서 활동하셨던 내역이 모두 삭제가 되니,<br>
														추후 재사용 하실 경우를 대비하여 탈퇴는 신중히 고려하신 후 진행하시길 바랍니다<br>
														<br>
														탈퇴방법은 아래와 같습니다.<br><br>
														<span style="line-height: 30px;">
														&nbsp;1단계.&nbsp; 로그인 후 기술자숲 첫 화면의 가장 하단에 있는 회원탈퇴 버튼을 클릭해주세요 <br>
                            &nbsp;2단계.&nbsp;. 기술자숲 회원탈퇴 완료 메시지가 뜨면 탈퇴처리가 됩니다. <br><br>
                            ※ 소셜(네이버, 페이스북)계정도 회원탈퇴 방법은 동일하게 진행됩니다. <br>
													</span>
			                    </p>
			                </li>

			                <li class="on">
			                    <!-- <p class="q d-none"><a>아이디와 비밀번호를 잊어버렸는데 어떻게 알 수 있을까요?</a></p> -->
													<p class="q"><a>아이디와 비밀번호를 잊어버리면 어떻게 하나요?</a></p>
			                    <p class="a">
														[아이디찾기]<br><br>
														&nbsp;1단계.&nbsp; 기술자숲 첫 화면에서 [로그인]버튼을 클릭하여 로그인페이지를 열어 [아이디찾기]를 누릅니다.<br>
														&nbsp;2단계.&nbsp; 회원님의 정보를 입력하여 절차에 따라 진행합니다..<br>
														&nbsp;3단계.&nbsp; 회원님 명의로 가입된 아이디를 확인하실 수 있습니다.<br><br>
														<!-- &nbsp;&nbsp;- 개인정보보호를 위해 일부분은 *로 표시됩니다.<br><br> -->
														[비밀번호 찾기]<br><br>
														&nbsp;1단계.&nbsp; 기술자숲 첫 화면에서 [로그인]버튼을 클릭하여 로그인페이지를 열어 [비밀번호찾기]를 누릅니다.<br>
														&nbsp;2단계.&nbsp; 회원님의 정보 및 아이디를 입력하여 절차에 따라 진행합니다.<br>
														&nbsp;3단계.&nbsp; 새롭게 변경하고자 하는 비밀번호로 변경후에 사이트를 이용해주시길 바랍니다.<br>
			                    </p>
			                </li>

                      <li class="on">
                          <p class="q"><a>담당자 연락처나 정보를 변경하고 싶어요</a></p>
                          <p class="a">
                            [메뉴]-[내정보관리]-[내정보설정]페이지에서 담당자의 연락처, 이메일, 이름을 변경할 수 있습니다.<br>
                            공고 등록 시 기존 담당자가 아닌 다른 담당자의 연락처를 작성할때는 [공고등록] 페이지의 [1단계 기업정보 등록] 단계에서 <br>
                            해당 담당자의 연락처, 이메일 주소를 입력할 수 있습니다. <br>
                            또한 [2단계 공고등록] 단계에서 최하단에 담당자 정보를 작성하는 란에서 수정 가능합니다.
                          </p>
                      </li>

                      <li class="on">
                          <p class="q"><a>제가 원하는 알림만 받고싶어요.</a></p>
                          <p class="a">
                            기술자숲에서 제공하는 알림 중 본인이 원하는 알림만 제한적으로 설정하고 싶으신 분들은<br>
                            [메뉴]-[내정보관리]-[알림설정] 혹은 우측상단의 종모양을 클릭하여 알림센터에서 우측상단의 설정을 클릭하여 들어간 후,<br>
                            나에게 필요한 알림과 제한할 알림을 수정해주시면 됩니다.<br>
                            만약 다시 알림을 받기 원하신다면 똑같은 방법으로 접속하여 수정하여 주시면 됩니다.
                          </p>
                      </li>
			            </ul>
			        </div>
			    </div>

		</section>

	</div>
</section>

<script type="text/javascript">
var on_changed = 1;
  $('.on').click(function(){
    $(this).toggleClass('changed');
    // if(on_changed == 1){
    // 	$(this).children('.a').css({
    // 		"display" : "block",
    // 	});
    // 	on_changed++;
    // }else{
    // 	$(this).children('.a').css({
    // 		"display" : "none",
    // 	});
    // 	on_changed--;
    // }

  });
  function checking(check_ox){
    if(check_ox==1){
      $(".member").css("display","block");
      $(".commerce").css("display","none");
      $("#check_m").attr("src", '/oPage/contact/images/check_o.png');
      $("#check_c").attr("src", '/oPage/contact/images/check_x.png');
      $("#mem").css("color", 'black');
      $("#com").css("color", '#b3b2b3');
    }else{
      $(".member").css("display","none");
      $(".commerce").css("display","block");
      $("#check_m").attr("src", '/oPage/contact/images/check_x.png');
      $("#check_c").attr("src", '/oPage/contact/images/check_o.png');
      $("#mem").css("color", '#b3b2b3');
      $("#com").css("color", 'black');
    }
  }


</script>
<?php
$footer_false = true;

?>
