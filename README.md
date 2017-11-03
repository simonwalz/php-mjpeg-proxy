# php-mjpeg-proxy

A simple php proxy for forwarding a mjpeg stream from a webcam.

* ``proxy_mjpeg.php`` sends file webcam_offline.jpg on error.
* ``proxy_mjpeg_error.php`` sends 503 http error on error. See ``proxy_mjpeg_error_view.html`` as well.

## Configuration

Define ``$mjpeg_url`` in ``proxy_mjpeg*.php``.


