<!DOCTYPE html>
<html>
<head>
	<title>Supplier form - Oxygene Portal</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        @page { margin-top: 120px; margin-bottom: 120px}
        header { position: fixed; left: 0px; top: -90px; right: 0px; height: 150px; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -145px; right: 0px; height: 150px; }
        body{
            font-family: 'Montserrat', sans-serif;
        }
        footer a{
            color: #03263e;
            font-weight: 800;
        }
        footer label{
            color: #ea5d27;
            font-weight: 800;
        }
        footer .bottom{
            color: #ea5d27;
        }
        footer{
            margin-top:0px;
            margin-bottom:0px;
            width: 100%; 
            font-size:9px; 
            text-align:left; 
        }
        .table {
            margin-bottom:0px;
            width: 100%;
            text-align: left ;
        }
        /* .table-borderless > tbody > tr > td,
        .table-borderless > tbody > tr > th,
        .table-borderless > tfoot > tr > td,
        .table-borderless > tfoot > tr > th,
        .table-borderless > thead > tr > td,
        .table-borderless > thead > tr > th {
            border: 1px solid;
        } */
        .table .header{
            background: #323c4f;
            color: #fff;
            padding:25px 15px;
        }
        .table .header h6{
            font-weight: 400;
        }
        .table .header h5{
            font-weight: 600;
        }
        /* .table .header.title{
            padding: 5px;
        } */
        .table .header .page-break{
            font-weight: 700;
        }
        .page-break {
            page-break-after: always;
        }

        label{
            margin-bottom: 0px;
        }
        input[type="date"].field-data,
        input[type="email"].field-data,
        input[type="number"].field-data,
        input[type="text"].field-data{
            border:none;
            border-bottom:thin dashed #c9c9c9;
            outline: none ;
            width: 100%;
        }
        .answer{
            border:none;
            border-bottom:thin dashed #c9c9c9;
            outline: none;
            width: 100%;
            resize:none;
        }
        /* .dotted_text{
            font-size:0.7rem;
        } */
        .border-the-table{
            margin-bottom:35px;
        }
        .tw-20px{
            width:53px;
        }
        .tw-280px{
            width: 400px;
        }
        .td-none{
            visibility: collapse;
        }
        .tw-25{
            width: 25% ;
        }
        .tw-75{
            width: 75% ;
        }
        .table-bordered td,
        .table-bordered td{
            vertical-align: bottom;
            border: 1px solid gray;
        }
        table.no-spacing {
            border-spacing:0; /* Removes the cell spacing via CSS */
            border-collapse: collapse;  /* Optional - if you don't want to have double border where cells touch */
        }
        .mb-0{
            margin: 0;
        }
        .text-right{
            text-align: right;
        }
        .text-left{
            text-align: left;
        }
        /* .signature .mb-3{    
            display: inline-flex;
            width: 75%;
        } */
        /* .signature label{    
            width: 50%;
            text-align: right;
        }
        .signature .dotted-line{
            display:none;
        } */

        /* HIDE CLASSES */
        @media .print {
            .noprint { display: none; }
            .container {
                max-width: 100%;
                padding: 0;
            }
            .border-the-table{
                margin-bottom:0px;
            }
            .logo{
                height: 30px;
            }
            /* 
            .signature .mb-3, */
            .signature label,
            .signature .answer,
            ol li,
            .table-bordered td,
            .header h5,
            .header th,
            p{
                font-size:0.7rem;
            }
            input[type="date"].field-data,
            input[type="email"].field-data,
            input[type="number"].field-data,
            input[type="text"].field-data,
            textarea.field-data{
                display: none ;
            }
            .tw-20px{
                width:28px;
            }
            .tw-280px{
                width: 250px;
            }
            .table td, .table th {
                padding: .5rem;
            }
            th.text-right.px-0,{
                padding-left: 0;
                padding-right: 0;
            }
            .td-none{
                visibility: inherit;
            }
            .tw-25{
                width: 25% ;
            }
            .tw-75{
                width: 85% ;
            }
            /* .signature .dotted-line{
                display: inline-flex;
                border-bottom: thin dashed #c9c9c9;
                width: 50%;
            } */
        }
    </style>
</head>
<body>
    <script type="text/php">
        if ( isset($pdf) ) {
            $y = $pdf->get_height() - 20; 
            $x = $pdf->get_width() - 15 - 50;
            $pdf->page_text($x, $y, "Page No: {PAGE_NUM} of {PAGE_COUNT}", '', 8, array(0,0,0));
        }
    </script> 
    <header class="text-right px-0 td-none">
        <img src="{{ $logo }}" alt="Logo" class="logo">
    </header>
    
    <footer id="footer" class="td-none">
        <div>
            <div>Oxygène Marketing Communication Ltd</div>
            <div>6th Floor, Lenana Towers 843, Lenana Rd, P.O. Box 34623 - 00100 Nairobi-Kenya</div>
            <div><label for="T">T</label> <a href="tel:+254 798 204 476">+254 798 204 476</a>, <a href="tel:+254 762 790 167">+254 762 790 167</a> | <label for="E">E</label> <a href="mailto:finance@oxygene.co.ke">finance@oxygene.co.ke</a> | <a href="oxygene.co.ke">www.oxygene.co.ke</a></div>
            <div class="bottom"><b>OXYGENE MARKETING COMMUNICATION LIMITED</b> SUPPLIER FORM No.: <strong>{{$data->supplier_number}}</strong></div>
        </div>
    </footer>
    @yield('content')
</body>
</html>