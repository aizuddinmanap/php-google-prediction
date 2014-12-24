# An example how to use Google Prediction API in php

aizuddinmanap@gmail.com

### Register free 6 month trial of Google Developers.
* Enable Google Prediction API and Google Cloud Storage.
* Generate Client ID with Service Account Type

### Upload Training Data

In this step you will upload a file of training data to your Google Cloud Storage account.

* Upload the file(language_id.txt) to Google Cloud Storage:
* Go to the Google Developers Console.
* Select the project under which to store the data.
* Select the "Cloud Storage" tab.
* Click "New Bucket" or select an existing bucket.
* Click on the bucket to which to upload the file, and click "Upload"
* Create a new bucket by clicking New Bucket.
* Select the bucket and click Upload, and upload the language_id.txt file from your computer.
* Copy the bucket/path name of your file from the path column in the Google Cloud Storage Manager. For example: mybucket/language_id.txt

### composer update
Run:

```sh
composer update
```

### Train the System

The next step is to train the system against the training data that you uploaded.

Run:

```sh
http://localhost/php-google-prediction/train.php
```

### Send Queries

Now you're ready to send queries to your model. Queries are always in the format of a single row of training data, minus the first column. Your training data had two columns: language_label, phrase_in_that_language; therefore a query against this data consists of a single column: a phrase in a language that you want to identify. Your phrase must be in one of the languages used in your training data. Google Prediction replies with its best guess at the language of your phrase.

Run:

```sh
http://localhost/php-google-prediction/predict.php
```

### License
----

MIT

aizuddinmanap@gmail.com