<section class="bg-white">
    <div class="content_padding mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">이력서 등록</h5>
    </div>
    <hr />
    <div class="content_padding mt-0 pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>기본정보</h6>
                </div>
                <div class="col-5 mx-auto px-auto">
                    <div class="position-relative">
                        <a class="position-absolute text-primary" style="right:0;top:0; font-size:28px;z-index:10;"><i class="xi-close-circle"></i></a>
                        <div class="avatar square mb-2" style="background-image:url('/layout/none/assets/images/no_avatar.png');">
                        </div>
                        <i class="xi-camera position-absolute text-white" style="right:0;bottom:0; font-size:28px;"></i>
                        <i class="xi-camera position-absolute text-secondary" style="right:1px;bottom:1px; font-size:26px;"></i>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>한줄자기소개</h6>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <input type="text" class="form-control" value="" placeholder="입력 칸(책임감 있는 열정적인 10년차 용접사!)" />
                </div>
                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>이름</h6>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <input type="text" class="form-control" value="" placeholder="" />
                </div>
                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>성별</h6>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <select class="form-control"><option>남자</option></select>
                </div>
                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>생년월일</h6>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <input type="text" class="form-control" value="" placeholder="" />
                </div>

                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>전화번호</h6>
                </div>
                <div class="col-12 mx-0 px-0 pl-1 mb-2">
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

                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>이메일</h6>
                </div>
                <div class="col-12 mx-0 px-0 pl-1 mb-2">
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

                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>주소</h6>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="input-group mb-2 overflow-hidden rounded">
                        <input type="text" class="form-control" id="address"  value="<?=$logged_info['address']?>" placeholder="주소검색" readonly>
                        <button type="button" class="btn btn-primary rounded-0" onclick="search_address()">검색</button>
                    </div>
                    <input type="text" class="form-control" id="address2" value="<?=$logged_info['address2']?>" placeholder="상세주소">
                </div>

                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>희망급여</h6>
                </div>
                <div class="col-12 mx-0 px-0 pl-1 mb-2">
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

                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>희망근무지</h6>
                </div>
                <div class="col-12 mx-0 px-0 pl-1 mb-2">
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

                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>희망직종</h6>
                </div>
                <div class="col-12 mx-0 px-0 pl-1 mb-2">
                    <select class="form-control">
                        <option>기계/제조</option>
                    </select>
                </div>

                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>희망직무</h6>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
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


                <div class="col-12 mt-3 mx-0 px-0">
                    <h6 class="bg-primary text-white text-center py-2">경력 간단 요약</h6>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <textarea rows="3" class="form-control"></textarea>
                </div>

                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>학력</h6>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="added_card border rounded position-relative rounded-0 rounded-top container py-3">
                        <a href="#" class="position-absolute" style="right:10px; top:10px;"><i class="xi-close"></i></a>
                        <h6 class="mt-3">학교구분</h6>
                        <div class="input-group">
                            <select class="form-control">
                                <option>고등학교</option>
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text">검정고시 <i class="xi-check-circle-o" onclick="jQuery(this).toggleClass('xi-check-circle-o'); jQuery(this).toggleClass('xi-check-circle')"></i></span>
                            </div>
                        </div>
                        <h6 class="mt-3">학교명</h6>
                        <div class="input-group">
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
                        <h6 class="mt-3">전공</h6>
                        <input type="text" class="form-control" placeholder="기계전공"/>
                    </div>
                    <a href="#" class="btn btn-warning btn-block rounded-0 rounded-bottom">추가하기</a>
                </div>


                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>경력</h6>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="added_card border rounded position-relative rounded-0 rounded-top container py-3">
                        <a href="#" class="position-absolute" style="right:10px; top:10px;"><i class="xi-close"></i></a>
                        <h6 class="mt-3">기업명</h6>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="기술 주식회사"/>
                            <input type="text" class="form-control" placeholder="직위(직급) 입력"/>
                        </div>
                        <h6 class="mt-3">직종</h6>
                        <div class="input-group">
                            <select class="form-control">
                                <option>기계/제조</option>
                            </select>
                            <select class="form-control">
                                <option>직위(직급) 선택</option>
                                <option>NCT</option>
                            </select>
                        </div>
                        <h6 class="mt-3">근무기간</h6>
                        <div class="input-group">
<!--                            date picker 쓰실거죠?-->
                            <input type="text" class="form-control" placeholder=""/>
                            <div class="input-group-append">
                                <span class="input-group-text">~</span>
                            </div>
                            <input type="text" class="form-control" placeholder=""/>
                        </div>
                        <h6 class="mt-3">직무내용</h6>
                        <input type="text" class="form-control" placeholder=""/>
                    </div>
                    <a href="#" class="btn btn-warning btn-block rounded-0 rounded-bottom">추가하기</a>
                </div>


                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>자격증</h6>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="added_card border rounded position-relative rounded-0 rounded-top container py-3">
                        <a href="#" class="position-absolute" style="right:10px; top:10px;"><i class="xi-close"></i></a>
                        <h6 class="mt-3">자격증 명</h6>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="용접기술사"/>
<!--                            datepicker-->
                            <input type="text" class="form-control" placeholder="취득일자"/>
                        </div>
                    </div>
                    <a href="#" class="btn btn-warning btn-block rounded-0 rounded-bottom">추가하기</a>
                </div>


                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>어학</h6>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="added_card border rounded position-relative rounded-0 rounded-top container py-3">
                        <a href="#" class="position-absolute" style="right:10px; top:10px;"><i class="xi-close"></i></a>
                        <h6 class="mt-3">언어</h6>
                        <div class="input-group">
                            <select class="form-control">
                                <option>영어</option>
                            </select>

                            <select class="form-control">
                                <option>영어</option>
                            </select>
                        </div>
                        <h6 class="mt-3">언어</h6>
                        <div class="input-group">
                            <select class="form-control">
                                <option>TOEIC</option>
                            </select>

                            <select class="form-control">
                                <option>TOEIC</option>
                            </select>
                        </div>
                        <h6 class="mt-3">점수</h6>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="990"/>
                            <div class="input-group-append">
                                <span class="input-group-text">점 (급)</span>
                            </div>
                        </div>
                        <h6 class="mt-3">취득날짜</h6>
<!--                        datepicker -->
                        <input type="text" class="form-control" placeholder=""/>
                    </div>
                    <a href="#" class="btn btn-warning btn-block rounded-0 rounded-bottom">추가하기</a>
                </div>

                <div class="col-12 mt-3 mx-0 px-0">
                    <h6>관련 서류 등록하기</h6>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="file_item border rounded py-2 px-2 mb-2">
                        <i class="xi-download pull-right xi-2x"></i>
                        [이력서] ic_launcher_1024.png
                    </div>
                    <div class="file_item border rounded py-2 px-2 mb-2">
                        <i class="xi-download pull-right xi-2x"></i>
                        [이력서] ic_launcher_1024.png
                    </div>
                    <div class="file_item border rounded py-2 px-2 mb-2">
                        <i class="xi-download pull-right xi-2x"></i>
                        [이력서] ic_launcher_1024.png
                    </div>
                    <div class="file_item border rounded py-2 px-2 mb-2">
                        <i class="xi-download pull-right xi-2x"></i>
                        [이력서] ic_launcher_1024.png
                    </div>
                    <a href="#" class="btn btn-warning btn-block rounded-0 rounded-bottom">추가하기</a>
                </div>

            </div>

            <input type="submit" class="btn btn-primary btn-round btn-lg btn-block my-3" value="저장" />
        </div>
    </div>
</section>
<?php $footer_false = true; ?>