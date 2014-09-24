Autodeploy
==========

## Git + MySQL Auto-Deployment

### Disclaimer

Use of this package is entirely at your own risk. We will not be held accountable for any security breaches, mistakes or otherwise that negatively impact you or your organization.

---

### How It Works

This script invokes a shell script that:
1. Optionally pulls the latest version of your files & database from Git to a specified server.
    * `git reset --hard` is performed prior to doing this to avoid merge conflicts.
2. Optionally performs a string find-and-replace on a specified MySQL file and runs the edited DB file as a SQL query, without modifying the original file.
    * This is especially good for CMS whose URLs are hardcoded into their databases (I'm looking at you, **Wordpress**).
    * It is important to note that `DROP TABLE` commands should be present if replacing a MySQL database on-server.

### Prerequisites

* A Linux server running Apache 2.3+ and PHP 5.3+.
* Git set up on your deployment server if you wish to use the Git feature.
* A MySQL database if you wish to use the MySQL deployment feature.
* PHP `shell_exec` **must** be enabled.

### Instructions

* Clone your site from Git if you intend to use the Git auto-deployment feature.
* Place the `deployment` and `db` folders into your site's/app's root directory.
* Change `define('ACCESS_TOKEN', 'xxxxx')` to a passcode of your choosing in `deployment/index.php`.
* Add your database details to `deployment/dbup.cfg`.
    * Replace `db.sql` with the relative location of your SQL file.
    
#### If you'd like to auto-deploy your files from Git
* Ensure that `git=true` is present in the URL's query string. More details below.

#### If you're deploying a MySQL database
* Ensure that `sql=true` is present in the URL's query string. More details below.
* Before committing to Git, do the following:
    * Backup your MySQL database and give it the filename `db.sql`.
    * Replace the `db.sql` file in the `db` folder with the freshly dumped one.

#### Building the URL

* Your URL should resemble the following:
    * `http://your-site.com/deployment/?token=xxxxx&git=true&sql=true`
    * Replace `token=xxxxx` with whatever you defined in `deployment/index.php`.
    * Remove the `git=true` or `sql=true` portions from the URL if you only need either or.
* Visit the URL to auto-deploy your site. Expect it to take some time, especially if using a shared server.
    
#### Deploying Automatically from Git

* Add the URL specified above as a POST hook from your Git interface of choice. Both GitHub and BitBucket support the hook.

---

Enjoy!
- Ben Ceg.