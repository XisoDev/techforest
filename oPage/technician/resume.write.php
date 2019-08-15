<?php
//한줄자기소개
$a_line_self = $output->get('a_line_row');
//이력서 정보
$resume_row = $output->get('resume_row');

//한줄자기소개 랜덤 힌트
$rand_array = array(
  "최고를 위해 늘 최선을 다하는 기술자",
  "함께 달리고 싶은 열정 지원자 입니다.",
  "새로운 도전을 준비하는 열혈 기술자",
  "최상의 결과를 이끌어 낼 준비된 인재입니다.",
  "적극적인 마인드로 업무를 해내겠습니다",
  "책임감을 가지고 성실히 일하는 지원자입니다.",
  "풍부한 실무경험을 갖고 있는 준비된 인재입니다.",
  "열심히 땀흘리는 성실한 기술자",
  "성실과 열정으로 내일의 가능성을 열겠습니다.",
  "책임감을 갖고 맡은 바 최선을 다하겠습니다.",
  "많은 현장경험으로 최고의 성과를 내겠습니다.",
  "시간약속을 잘 지키는 성실한 기술자입니다.",
  "주인의식을 가지고 성실히 일 할 자신있습니다.",
  "오랜 경력을 바탕으로 열심히 일하겠습니다.",
  "늘 한 길만 묵묵히 걸어온 노력파 인재",
  "오랜 경력으로 쌓은 전문성을 발휘하겠습니다.",
  "모든 일을 책임감있게 할 수 있습니다.",
  "손발이 빠르고 성실한 프로입니다.",
  "오랜 현장경험으로 쌓은 눈썰미로 제 몫을 해내겠습니다.",
  "오랜 현장경험으로 바로 업무투입이 가능합니다.",
  "적극적인 사고와 소통이 특기인 숙련 기술자입니다.",
  "목표를 향해 달리는 마라토너 같은 기술자");
shuffle($rand_array);


?>

<section class="sub_visual d-none d-lg-block pb-2" style="background-image:url('<?=$no_auto_bg_url?>');">
    <h4 class="red"><?=$site_info->title?></h4>
    <p class="weight_normal text-secondary pb-0 my-0"><?=$site_info->desc?></h4></p>
    <p class="weight_lighter text-secondary pt-0 pb-2 my-0">기술자숲이 대신 작성해 드립니다.</h4></p>
    <a href="#" class="btn btn-danger">이력서파일 등록하기</a>
    <p class="red xs_content weight_lighter">*영업일 기준 1일 소요됩니다.</p>
</section>
<section class="bg-white">
    <div class="d-block d-lg-none">
        <div class="content_padding mt-4 pt-5 mb-0 pb-2">
            <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
            <h5 class="weight_normal">이력서 등록</h5>
        </div>
        <hr />
    </div>
    <div class="mt-0 pt-0">
        <div class="container">
            <div class="row col-md-10 col-lg-9 mx-md-auto mb-md-4 px-0 mx-0">
                <div class="col-12 mt-3 mt-lg-5 mx-0 px-0">
                    <h6 class="d-block d-lg-none">기본정보</h6>
                    <h4 class="d-none d-lg-block">기본정보</h4>
                </div>
                <div class="col-5 col-sm-4 col-lg-3 mx-auto px-auto">
                    <div class="position-relative">
                        <a class="position-absolute text-primary" style="right:0;top:0; font-size:28px;z-index:10;"><i class="xi-close-circle"></i></a>
                        <div class="avatar square mb-2" style="background-image:url('/layout/none/assets/images/no_avatar.png');">
                        </div>
                        <i class="xi-camera position-absolute text-white" style="right:0;bottom:0; font-size:28px;"></i>
                        <i class="xi-camera position-absolute text-secondary" style="right:1px;bottom:1px; font-size:26px;"></i>
                    </div>
                </div>
            </div>

            <div class="row col-md-10 col-lg-9 mx-md-auto mb-md-4 px-0 mx-0">
                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>한줄자기소개</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <input type="text" class="form-control" value="<?=$a_line_self[0]['a_line_self']?>" placeholder="<?=$rand_array[0]?>" />
                </div>
                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>이름</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <input type="text" class="form-control" value="<?=$resume_row[0]['m_name']?>" placeholder="" />
                </div>
                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>성별</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <select class="form-control">
                      <option value="M" <?if($resume_row[0]["m_human"] == "M") { echo "selected=\"selected\"";}?>>남자</option>
                      <option value="F" <?if($resume_row[0]["m_human"] == "F") { echo "selected=\"selected\"";}?>>여자</option>
                    </select>
                </div>
                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>생년월일</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <input type="text" class="form-control" value="" placeholder="" />
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>전화번호</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <div class="input-group">
                        <select class="form-control" id="phone1">
                            <option value="010" selected="selected">010</option>
                            <option value="011">011</option>
                            <option value="017">017</option>
                            <option value="051">051</option>
                        </select>
                        <div class="input-group-prepend">
                            <span class="input-group-text">-</span>
                        </div>
                        <input type="text" class="form-control" id="phone2" placeholder="0000">
                        <div class="input-group-prepend">
                            <span class="input-group-text">-</span>
                        </div>
                        <input type="text" class="form-control" id="phone3" placeholder="0000">
                    </div>
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>이메일</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <div class="input-group">
                        <input type="text" class="form-control" id="m_email1" placeholder="이메일 주소 입력">
                        <div class="input-group-prepend">
                  <span class="input-group-text">
                      @
                  </span>
                        </div>
                        <input type="text" class="form-control" id="m_email2" placeholder="직접입력" style="">
                        <button class="dropdown-toggle" type="button" id="email_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="caret"></span></button>
                        <ul id="email_list" class="dropdown-menu" aria-labelledby="email_btn" style="">
                            <li class="" onclick="click_email('naver.com')">naver.com</li>
                            <li role="separator" class="divider"></li>
                            <li class="" onclick="click_email('hanmail.net')">hanmail.net</li>
                            <li role="separator" class="divider"></li>
                            <li class="" onclick="click_email('nate.com')">nate.com</li>
                            <li role="separator" class="divider"></li>
                            <li class="" onclick="click_email('daum.net')">daum.net</li>
                            <li role="separator" class="divider"></li>
                            <li class="" onclick="click_email('google.com')">google.com</li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>주소</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <div class="input-group mb-2 overflow-hidden rounded">
                        <input type="text" class="form-control" id="address"  value="<?=$logged_info['address']?>" placeholder="주소검색" readonly>
                        <button type="button" class="btn btn-primary rounded-0" onclick="search_address()">검색</button>
                    </div>
                    <input type="text" class="form-control" id="address2" value="<?=$logged_info['address2']?>" placeholder="상세주소">
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>희망급여</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <div class="input-group">
                        <select class="form-control">
                            <option>일급</option>
                        </select>
                        <input type="text" class="form-control" placeholder="50,000"/>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">원 이상</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>희망근무지</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <div class="input-group">
                        <select class="form-control">
                            <option>경남</option>
                        </select>
                        <select class="form-control">
                            <option>창원시</option>
                        </select>
                        <select class="form-control">
                            <option>마산회원구</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>희망직종</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <select class="form-control">
                        <option>기계/제조</option>
                    </select>
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>희망직무</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <span class="selected_item text-secondary xs_content" onclick="jQuery(this).remove();"><i class="xi-close-circle"></i> 용접공</span>
                    <span class="selected_item text-secondary xs_content" onclick="jQuery(this).remove();"><i class="xi-close-circle"></i> 기계/제조 관리직</span>
                    <span class="selected_item text-secondary xs_content" onclick="jQuery(this).remove();"><i class="xi-close-circle"></i> 주물사</span>
                    <div class="input-group mb-2 overflow-hidden rounded mt-2">
                        <select class="form-control">
                            <option>직무를 선택 해 주세요.</option>
                        </select>
                        <button type="button" class="btn btn-primary rounded-0"">추가</button>
                    </div>
                </div>


                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6 class="d-none d-sm-block">자기소개 및<br />경력 간단 요약</h6>
                    <h6 class="d-block d-sm-none bg-primary text-white text-center py-2">경력 간단 요약</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <textarea rows="3" class="form-control"></textarea>
                </div>

            </div>

            <div class="row col-md-10 col-lg-9 mx-md-auto mb-md-4 px-0 mx-0">
                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">학력</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a href="#" class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        학력
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="added_card border rounded position-relative rounded-0 rounded-top container py-3 pt-sm-3 pb-sm-0">
                        <a href="#" class="position-absolute" style="right:10px; top:10px;"><i class="xi-close"></i></a>
                        <div class="row content_padding">
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교구분</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <select class="form-control">
                                    <option>고등학교</option>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text">검정고시 <i class="xi-check-circle-o" onclick="jQuery(this).toggleClass('xi-check-circle-o'); jQuery(this).toggleClass('xi-check-circle')"></i></span>
                                </div>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교명</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <input type="text" class="form-control" placeholder="기술 고등학교"/>
                                <select class="form-control">
                                    <option>졸업연도 선택</option>
                                    <option>2019-02</option>
                                    <option>2018-08</option>
                                    <option>2018-02</option>
                                    <option>2017-08</option>
                                    <option>2017-02</option>
                                </select>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">전공</h6>
                            <input type="text" class="form-control col-12 col-sm-9 mx-0 mb-2 mb-sm-0" placeholder="기계전공"/>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#" class="my-3 d-sm-inline-block d-none btn btn-warning">학력 추가하기</a>
                    </div>
                    <a href="#" class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom">학력 추가하기</a>
                </div>


                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">경력</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a href="#" class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        경력
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="added_card border rounded position-relative rounded-0 rounded-top container py-3 pb-sm-0">
                        <a href="#" class="position-absolute" style="right:10px; top:10px;"><i class="xi-close"></i></a>
                        <div class="row content_padding">
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">기업명</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <input type="text" class="form-control" placeholder="기술 주식회사"/>
                                <input type="text" class="form-control" placeholder="직위(직급) 입력"/>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">직종</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <select class="form-control">
                                    <option>기계/제조</option>
                                </select>
                                <select class="form-control">
                                    <option>직위(직급) 선택</option>
                                    <option>NCT</option>
                                </select>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">근무기간</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
    <!--                            date picker 쓰실거죠?-->
                                <input type="text" class="form-control" placeholder=""/>
                                <div class="input-group-append">
                                    <span class="input-group-text">~</span>
                                </div>
                                <input type="text" class="form-control" placeholder=""/>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">직무내용</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <input type="text" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#" class="my-3 d-sm-inline-block d-none btn btn-warning">경력 추가하기</a>
                    </div>
                    <a href="#" class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom">경력 추가하기</a>

                </div>

                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">자격증</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a href="#" class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        자격증
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="added_card border rounded position-relative rounded-0 rounded-top container py-3 pb-sm-0">
                        <a href="#" class="position-absolute" style="right:10px; top:10px;"><i class="xi-close"></i></a>
                        <div class="row content_padding">
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">자격증 명</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <input type="text" class="form-control" placeholder="용접기술사"/>
    <!--                            datepicker-->
                                <input type="text" class="form-control" placeholder="취득일자"/>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="#" class="my-3 d-sm-inline-block d-none btn btn-warning">자격증 추가하기</a>
                    </div>
                    <a href="#" class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom">자격증 추가하기</a>

                </div>


                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">어학</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a href="#" class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        어학
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="added_card border rounded position-relative rounded-0 rounded-top container py-3 pb-sm-0">
                        <a href="#" class="position-absolute" style="right:10px; top:10px;"><i class="xi-close"></i></a>
                        <div class="row content_padding">
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">언어</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <select class="form-control">
                                    <option>영어</option>
                                </select>

                                <select class="form-control">
                                    <option>영어</option>
                                </select>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">언어</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <select class="form-control">
                                    <option>TOEIC</option>
                                </select>

                                <select class="form-control">
                                    <option>TOEIC</option>
                                </select>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">점수</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <input type="text" class="form-control" placeholder="990"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">점 (급)</span>
                                </div>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">취득날짜</h6>
<!--                        datepicker -->
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <input type="text" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#" class="my-3 d-sm-inline-block d-none btn btn-warning">어학 추가하기</a>
                    </div>
                    <a href="#" class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom">어학 추가하기</a>

                </div>


                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">관련서류 등록하기</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a href="#" class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        관련서류 등록하기
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="file_item border rounded py-2 px-2 mb-2">
                        <i class="xi-trash pull-right xi-2x"></i>
                        <i class="xi-download pull-right xi-2x"></i>
                        [이력서] ic_launcher_1024.png
                    </div>
                    <div class="file_item border rounded py-2 px-2 mb-2">
                        <i class="xi-trash pull-right xi-2x"></i>
                        <i class="xi-download pull-right xi-2x"></i>
                        [이력서] ic_launcher_1024.png
                    </div>
                    <div class="file_item border rounded py-2 px-2 mb-2">
                        <i class="xi-trash pull-right xi-2x"></i>
                        <i class="xi-download pull-right xi-2x"></i>
                        [이력서] ic_launcher_1024.png
                    </div>
                    <div class="file_item border rounded py-2 px-2 mb-2">
                        <i class="xi-trash pull-right xi-2x"></i>
                        <i class="xi-download pull-right xi-2x"></i>
                        [이력서] ic_launcher_1024.png
                    </div>
                    <div class="text-center">
                        <a href="#" class="my-3 d-sm-inline-block d-none btn btn-warning">서류 추가하기</a>
                    </div>
                    <a href="#" class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom">서류 추가하기</a>

                </div>

            </div>

            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-6 col-sm-4">
                    <input type="submit" class="btn btn-block btn-light border-primary text-primary btn-round btn-lg my-3" value="취소" />
                </div>
                <div class="col-6 col-sm-4">
                    <input type="submit" class="btn btn-block btn-primary btn-round btn-lg my-3" value="저장" />
                </div>
            </div>
        </div>
    </div>
</section>
<?php $footer_false = true; ?>
