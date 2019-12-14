# MasjidBoard

Open Source Basic Notice Board For Masjids with the following features:
1. Show Salaah Times
2. Show both English and Islamic date
3. Show Sehri, Sunrise and Zawaal Times
4. Show upcomming Salaah time changes
5. Show General Masjid Notifications
6. Responsive, can be used on a TV screen in a Masjid and be used as a webpage for mobile device access.
7. Show the Masjids bank account infomation for donations  
8. Show the Masjid Contact Information
9. Allow community to register their details for record.

# Deployment Instructions.

1. Clone the repo to your webservers root directory
2. Run the SQL initialization script from db folder into a mysql database
3. Change your admin password in the DB table "admin"
4. Edit the configuration file with your masjid details (config/config.php)
5. Configure your masjids timetable via the admin interface <yoursite>/admin


# Screen Shot
![Masjid Board](/img/MasjidBoard.png)
