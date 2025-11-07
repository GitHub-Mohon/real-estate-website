
  <style>
    /* Sidebar */
    .sidebar {
      width: 220px;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      background: #fff;
      border-right: 1px solid #ddd;
      padding-top: 60px;
    }
    .sidebar h4 {
      padding-left: 20px;
      margin-bottom: 15px;
    }
    .sidebar a {
      padding: 12px 20px;
      display: block;
      color: #333;
      text-decoration: none;
      font-size: 17px;
      font-weight: 500;
    }
    .sidebar a.active, .sidebar a:hover {
      background: #eaf1ff;
      color: #0d6efd;
    }

    /* Topbar */
    .topbar {
      position: fixed;
      top: 0;
      left: 220px;
      right: 0;
      background: #4a6cf7;
      color: white;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      z-index: 1000;
    }

    /* Content */
    .content {
      margin-left: 220px;
      padding: 90px 20px 20px; /* pushes cards BELOW the blue bar */
    }

    /* Dashboard cards */
    .stat-card {
      display: flex;
      align-items: center;
      border-radius: 10px;
      background: #ebebeb;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      padding: 20px;
    }
    .stat-icon {
      font-size: 35px;
      width: 60px;
      height: 60px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      margin-right: 15px;
    }
    .bg-blue { background: #4a6cf7; }
    .bg-red { background: #f44336; }
    .bg-orange { background: #ff9800; }
    .stat-text h6 {
      margin: 0;
      font-size: 14px;
      color: #666;
    }
    .stat-text h3 {
      margin: 0;
      font-size: 22px;
      font-weight: bold;
      color: #333;
    }
  </style>
