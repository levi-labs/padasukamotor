 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link " href="{{ url('dashboard') }}">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav -->


         @if (auth()->user()->akses_user == 'Admin')
             <li class="nav-item">
                 <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                     <i class="bi bi-journal-text"></i><span>Daftar Barang</span><i
                         class="bi bi-chevron-down ms-auto"></i>
                 </a>
                 <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                     <li>
                         <a href="{{ url('daftar-barang') }}">
                             <i class="bi bi-circle"></i><span>Barang</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('daftar-barang-masuk') }}">
                             <i class="bi bi-circle"></i><span>Barang Masuk</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ url('daftar-barang-keluar') }}">
                             <i class="bi bi-circle"></i><span>Barang Keluar</span>
                         </a>
                     </li>
                 </ul>
             </li><!-- End Forms Nav -->
         @endif



         <li class="nav-item">
             <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-layout-text-window-reverse"></i><span>Transaksi</span><i
                     class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="{{ url('buat-cart') }}">
                         <i class="bi bi-circle"></i><span>Buat Transaksi</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('transaksi-berlangsung') }}">
                         <i class="bi bi-circle"></i><span>Transaksi Berlangsung</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('transaksi-berhasil') }}">
                         <i class="bi bi-circle"></i><span>Transaksi Berhasil</span>
                     </a>
                 </li>
             </ul>
         </li><!-- End Tables Nav -->





         <li class="nav-heading">Pages</li>
         @if (auth()->user()->akses_user == 'Admin')
             <li class="nav-item">
                 <a class="nav-link collapsed" href="{{ url('daftar-kategori') }}">
                     <i class="bi bi-card-list"></i>
                     <span>Kategori</span>
                 </a>
             </li><!-- End Profile Page Nav -->

             <li class="nav-item">
                 <a class="nav-link collapsed" href="{{ url('daftar-supplier') }}">
                     {{-- <i class="bi bi-question-circle"></i> --}}
                     <i class="bi bi-menu-button-wide"></i>
                     <span>Supplier</span>
                 </a>
             </li><!-- End F.A.Q Page Nav -->

             <li class="nav-item">
                 <a class="nav-link collapsed" href="{{ url('daftar-user') }}">
                     <i class="bi bi-person"></i>
                     <span>User Management</span>
                 </a>
             </li><!-- End Contact Page Nav -->


             <li class="nav-item">
                 <a class="nav-link collapsed" href="{{ url('report') }}">
                     <i class="bi bi-dash-circle"></i>
                     <span>Report</span>
                 </a>
             </li><!-- End Error 404 Page Nav -->
         @endif

         <li class="nav-item">
             <a class="nav-link collapsed" href="{{ url('logout') }}">
                 <i class="bi bi-box-arrow-in-right"></i>
                 <span>Logout</span>
             </a>
         </li><!-- End Login Page Nav -->

     </ul>

 </aside>
