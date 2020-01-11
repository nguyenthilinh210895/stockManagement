<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a href="{{route('home')}}">
                          <i class="fa fa-home"></i>
                          <span> Trang chủ</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-laptop"></i>
                          <span>Danh mục</span>
                      </a>
                      <ul class="sub">
                          <li class="sub-menu">
                              <a href="{{route('areas.index')}}">Khu vực</a>
                          </li>
                          <li class="sub-menu">
                              <a href="{{route('warehouses.index')}}">Kho hàng</a>
                          </li>
                          <li class="sub-menu">
                              <a href="{{route('zones.index')}}">Zone</a>
                          </li>
                          <li class="sub-menu">
                              <a href="{{route('items.index')}}">Nhóm vật tư</a>
                          </li>
                          <li class="sub-menu">
                              <a href="{{route('manufacturers.index')}}">Nhà cung cấp</a>
                          </li>
                          <li class="sub-menu">
                              <a href="{{route('qualitys.index')}}">Chất lượng</a>
                          </li>
                          <li class="sub-menu">
                              <a href="{{route('calculations.index')}}">Đơn vị tính</a>
                          </li>
                          <li class="sub-menu">
                              <a href="{{route('users.index')}}">Nhân viên</a>
                          </li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Quản lý </span>
                      </a>
                      <ul class="sub">
                          <li class="sub-menu">
                              <a href="{{route('products.index')}}">Vật tư </a>
                          </li>
                          <li class="sub-menu">
                              <a href="{{route('inputs.index')}}" >Nhập kho</a>
                          </li>
                          <li class="sub-menu">
                              <a href="{{route('outputs.index')}}" >Xuất kho</a>
                          </li>
                      </ul>
                  </li>

                  <!-- <li>
                      <a href="google_maps.html" > Google Maps </a>
                  </li> -->
              </ul>
        </div>
</aside>
