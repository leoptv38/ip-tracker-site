<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Yusha Tracking | IP Entry</title>
  
  <!-- Local stylesheet -->
  <link rel="stylesheet" href="assets/style.css" />
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" media="print" onload="this.media='all'" />

  <style>
    .home-link {
      transform: translateX(-50%);
      text-decoration: none;
    }
    .form-group label {
      font-weight: bold;
    }
    .form-group span {
      font-weight: normal;
    }
  </style>
</head>
<body>
  <form method="POST">
    <center style="padding: 5px;">
      <a class="home-link" href="/">
        <h2>Yusha Tracking | Medicare</h2>
      </a>
    </center>

    <h3>IP Entry</h3>

    <!-- IP field -->
    <div class="form-group ip">
      <label for="ip">IP Address</label>
      <div class="insert-button" style="display: flex; align-items: center;">
        <input type="text" id="ip" placeholder="IP Address" maxlength="40" readonly />
      </div>
    </div>

    <!-- Display data -->
    <div class="form-group">
      <label>City: <span id="city"></span></label>
    </div>
    
    <div class="form-group">
      <label>Country: <span id="country"></span></label>
    </div>
    
    <div class="form-group">
      <label>IP Address: <span id="ipAddress"></span></label>
    </div>
    
    <div class="form-group">
      <label>ISP: <span id="isp"></span></label>
    </div>
    
    <div class="form-group">
      <label>Region: <span id="region"></span></label>
    </div>

    <div id="userIPInfo"></div>

    <div class="form-group submit-btn">
      <input type="submit" value="Submit" />
    </div>
  </form>

  <!-- IP Fetch Script -->
  <script>
    function fetchUserIPInfo(ipifyResponse) {
      const ip = ipifyResponse.ip;
      getUserIPInfo(ip);
    }

    const apiUrl = '/get_ip.php';
    
    const getUserIPInfo = async (ip) => {
      try {
        const response = await fetch(apiUrl + "?ip=" + ip);
        const data = await response.json();
        
        if (data) {
          const ipInfo = data.data || data;
          document.getElementById('ip').value = data.original_ip;
          document.getElementById('city').textContent = ipInfo.city;
          document.getElementById('country').textContent = ipInfo.country;
          document.getElementById('ipAddress').textContent = data.original_ip;
          document.getElementById('isp').textContent = ipInfo.isp;
          document.getElementById('region').textContent = ipInfo.regionName;
        } else {
          console.error('Error fetching IP information:', data.reason);
        }
      } catch (error) {
        console.error('Error fetching IP information:', error);
      }
    };

    // Load user's IP using JSONP
    const script = document.createElement('script');
    script.src = 'https://api4.ipify.org?format=jsonp&callback=fetchUserIPInfo';
    document.body.appendChild(script);
  </script>

  <!-- Optional JS file -->
  <script src="assets/script.js?v=1.1" async></script>
</body>
</html>
