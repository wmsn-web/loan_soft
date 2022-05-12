<!doctype html>
                            <html>
                            <head>
                              <meta name="viewport" content="width=device-width" />
                              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                              <style>
                                body {
                                 background-color: #f6f6f6;
                                 font-family: sans-serif;
                                 -webkit-font-smoothing: antialiased;
                                 font-size: 14px;
                                 line-height: 1.4;
                                 margin: 0;
                                 padding: 0;
                                 -ms-text-size-adjust: 100%;
                                 -webkit-text-size-adjust: 100%;
                               }
                               table {
                                 border-collapse: separate;
                                 mso-table-lspace: 0pt;
                                 mso-table-rspace: 0pt;
                                 width: 100%;
                               }
                               table td {
                                 font-family: sans-serif;
                                 font-size: 14px;
                                 vertical-align: top;
                               }
                                   /* -------------------------------------
                                     BODY & CONTAINER
                                     ------------------------------------- */
                                     .body {
                                       background-color: #f6f6f6;
                                       width: 100%;
                                     }
                                     /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */

                                     .container {
                                       display: block;
                                       margin: 0 auto !important;
                                       /* makes it centered */
                                       max-width: 680px;
                                       padding: 10px;
                                       width: 680px;
                                     }
                                     /* This should also be a block element, so that it will fill 100% of the .container */

                                     .content {
                                       box-sizing: border-box;
                                       display: block;
                                       margin: 0 auto;
                                       max-width: 680px;
                                       padding: 10px;
                                     }
                                   /* -------------------------------------
                                     HEADER, FOOTER, MAIN
                                     ------------------------------------- */

                                     .main {
                                       background: #fff;
                                       border-radius: 3px;
                                       width: 100%;
                                     }
                                     .wrapper {
                                       box-sizing: border-box;
                                       padding: 20px;
                                     }
                                     .footer {
                                       clear: both;
                                       padding-top: 10px;
                                       text-align: center;
                                       width: 100%;
                                     }
                                     .footer td,
                                     .footer p,
                                     .footer span,
                                     .footer a {
                                       color: #999999;
                                       font-size: 12px;
                                       text-align: center;
                                     }
                                     hr {
                                       border: 0;
                                       border-bottom: 1px solid #f6f6f6;
                                       margin: 20px 0;
                                     }
                                   /* -------------------------------------
                                     RESPONSIVE AND MOBILE FRIENDLY STYLES
                                     ------------------------------------- */

                                     @media only screen and (max-width: 620px) {
                                       table[class=body] .content {
                                         padding: 0 !important;
                                       }
                                       table[class=body] .container {
                                         padding: 0 !important;
                                         width: 100% !important;
                                       }
                                       table[class=body] .main {
                                         border-left-width: 0 !important;
                                         border-radius: 0 !important;
                                         border-right-width: 0 !important;
                                       }
                                     }
                                   </style>
                                 </head>
                                 <body class="">
                                  <table border="0" cellpadding="0" cellspacing="0" class="body">
                                    <td>&nbsp;</td>
                                    <tr>
                                     <td class="container">
                                      <div class="content">
                                        <!-- START CENTERED WHITE CONTAINER -->
                                        <table class="main">
                                          <!-- START MAIN CONTENT AREA -->
                                          <tr style="background:#7A98AD">
                                                <td style="text-align: center; padding: 15px;">
                                                  <h4 style="color:#fff"><?= $header; ?></h4>
                                                </td>
                                              </tr>
                                    

                                          <tr>
                                           <td class="wrapper">
                                            <table border="0" cellpadding="0" cellspacing="0">
                                              
                                              <tr>
                                               <td>
                                                 <?= $message; ?>
                                               </td>
                             </tr>
                           </table>
                         </td>
                       </tr>
                       <!-- END MAIN CONTENT AREA -->
                     </table>
                     <!-- START FOOTER -->
                     <div class="footer">
                      <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="content-block">
                            <span><?= $company; ?></span>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <!-- END FOOTER -->
                    <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                </td>
                <td>&nbsp;</td>
              </tr>
            </table>
            </body>
            </html>