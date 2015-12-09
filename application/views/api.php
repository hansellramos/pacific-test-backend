<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Yuxi Pacific Hansel's Test - Api Functions</title>

    <style type="text/css">

        ::selection { background-color: #E13300; color: white; }
        ::-moz-selection { background-color: #E13300; color: white; }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }
    </style>
</head>
<body>

<div id="container">
    <h1>Technical Test</h1>

    <div id="body">
        <p>This web application is the result of development of Hansel Ramos for Yuxi Pacific as a requirement of the selection process.</p>
        <p>To upload use this link please <a href="<?= $url = site_url('book/upload') ?>"><?= $url ?></a> </p>
        <p>This web application have the next functions:
        <ul>
            <li>
                Get All
                <ul>
                    <li>Params: none</li>
                    <li>Call Format: <?= $url = site_url('book/all') ?></li>
                    <li>Call Example: <a href="<?= $url = site_url('book/all') ?>" target="_blank"><?= $url ?></a></li>
                </ul>
            </li>
            <li>
                Get By Language
                <ul>
                    <li>Params:
                        <ul>
                            <li>lang: represents the lang name on a book</li>
                        </ul>
                    </li>
                    <li>Call Format: <?= $url = site_url('book/lang') ?>/{lang}</li>
                    <li>Call Example: <a href="<?= $url = site_url('book/lang/Spanish') ?>" target="_blank"><?= $url ?></a></li>
                </ul>
            </li>
            <li>
                Get By Price
                <ul>
                    <li>Params:
                        <ul>
                            <li>comparision: represents the price comparision, the values must be over or less</li>
                            <li>value: represents the book price value to compare</li>
                        </ul>
                    </li>
                    <li>Call Format: <?= $url = site_url('book/price') ?>/{comparision}/{value}</li>
                    <li>Call Example: <a href="<?= $url = site_url('book/price/over/100') ?>" target="_blank"><?= $url ?></a></li>
                </ul>
            </li>
            <li>
                Get By Quantity
                <ul>
                    <li>Params:
                        <ul>
                            <li>comparision: represents the quantity comparision, the values must be over or less</li>
                            <li>value: represents the book quantity value to compare</li>
                        </ul>
                    </li>
                    <li>Call Format: <?= $url = site_url('book/quantity') ?>/{comparision}/{value}</li>
                    <li>Call Example: <a href="<?= $url = site_url('book/quantity/less/100') ?>" target="_blank"><?= $url ?></a></li>
                </ul>
            </li>
        </ul>
        </p>
    </div>

    <p class="footer"><strong>CodeIgniter Version <?= CI_VERSION ?></strong></p>
</div>

</body>
</html>