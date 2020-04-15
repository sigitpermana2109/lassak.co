<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url('admin/Home'); ?>">Lassak.co</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('admin/Home'); ?>">L.co</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="">
              <a class="nav-link" href="<?= base_url('Admin/home'); ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>
            
            <li class="menu-header">Pages</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Manajemen User</span></a>
              <ul class="dropdown-menu">
                <li><a href="<?= base_url('Admin/Admin'); ?>">Admin</a></li> 
                <li><a href="<?= base_url('Admin/Member'); ?>">Member</a></li> 
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-box"></i> <span>Manajemen Barang</span></a>
              <ul class="dropdown-menu">
                <li><a href="<?= base_url('Admin/Barang'); ?>">Barang</a></li> 
                <li><a href="<?= base_url('Admin/Kategori'); ?>">Kategori</a></li> 
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Manajemen Ongkir</span></a>
              <ul class="dropdown-menu">
                <li><a href="<?= base_url('Admin/Kurir'); ?>">Kurir</a></li>
                <li><a href="<?= base_url('Admin/Ongkir'); ?>">Ongkir</a></li>  
              </ul>
            </li>
            <li class="<?php echo $this->uri->segment(2) == 'blank' ? 'active' : ''; ?>">
              <a class="nav-link" href="<?= base_url('Admin/Bank'); ?>"><i class="fas fa-university"></i> <span>Bank</span></a>
            </li>
            <li class="<?php echo $this->uri->segment(2) == 'blank' ? 'active' : ''; ?>">
              <a class="nav-link" href="<?= base_url('Admin/Transaksi'); ?>"><i class="fas fa-money-check-alt"></i> <span>Transaksi</span></a>
            </li>
          </ul>

          
        </aside>
      </div>
