<style>
    body{
        font-family: arial;
        font-size: 14px;
    }
    table{
        width: 100%;
        border: 0px;
        border-collapse: collapse;
    }
    table tr td{
        border: 1px solid gray; 
        padding: 3px 10px;
    }
    table tr th{
        border: 1px solid gray; 
        padding: 3px 10px;
        background-color: #EEE;
    }
    .text-center{
        text-align: center;
    }
    .text-right{
        text-align: right;
    }
    .text-left{
        text-align: left;
    }
    h1{
        font-weight: 600;
        border-bottom: 1px solid gray;
        margin-bottom: 15px;
    }
    #img-logo{
        width: 60px;
        margin-right: 30px;
    }
    .table-simple tr td{
        border: 0px;
    }
    [class*="col-"]{
        float:left;
    }
    .col-1{ float: left; width: 7%; padding: 10px; }
    .col-2{ float: left; width: 17%; padding: 10px;  }
    .col-3{ float: left; width: 27%; padding: 10px;  }
    .col-4{ float: left; width: 37%; padding: 10px;  }
    .col-5{ float: left; width: 47%; padding: 10px;  }
    .col-6{ float: left; width: 57%; padding: 10px;  }
    .col-7{ float: left; width: 67%; padding: 10px;  }
    .col-8{ float: left; width: 77%; padding: 10px;  }
    .col-9{ float: left; width: 87%; padding: 10px;  }
    .col-10{ width: 100%; }
    .table-row tr td{
        border-bottom: 1px solid grey;
    }
    .row{
        clear: both;
    }
    .img-res{
        width: 100%;
    }
</style>
<html>
    <body>
        
        <h1><img id="img-logo" src="<?= Sis::UrlRecursos() ?>pics/logo-reportes.png"> <?= $this->tituloPagina ?></h1>
        <?= $this->contenido ?>

    </body>
</html>