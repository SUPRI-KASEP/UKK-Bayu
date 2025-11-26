@extends('admin.template')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
<script src="https://kit.fontawesome.com/a2e0f1f6d2.js" crossorigin="anonymous"></script>


<div class="all">
    <div class="card-info">
        <h4>Jumlah Toko</h4>
        <span id="jumlahToko">{{ $jumlahToko ?? 0 }}</span>
    </div>

    <div class="card-info">
        <h4>Jumlah Kategori</h4>
        <span id="jumlahKategori">{{ $jumlahKategori ?? 0 }}</span>
    </div>

    <div class="card-info">
        <h4>Jumlah User</h4>
        <span id="jumlahUser">{{ $jumlahUser ?? 0 }}</span>
    </div>
</div>

<script>
  // Toggle Sidebar
  function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const isMobile = window.innerWidth <= 768;
    
    if (isMobile) {
      sidebar.classList.toggle("show");
      overlay.classList.toggle("active");
    } else {
      sidebar.classList.toggle("collapsed");
      localStorage.setItem(
        "sidebar",
        sidebar.classList.contains("collapsed") ? "collapsed" : "expanded"
      );
    }
  }

  document.addEventListener("DOMContentLoaded", function () {
    const sidebarState = localStorage.getItem("sidebar");
    if (sidebarState === "collapsed" && window.innerWidth > 768) {
      document.getElementById("sidebar").classList.add("collapsed");
    }
  });
</script>
@endsection
