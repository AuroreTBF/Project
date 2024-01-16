<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <?php
    $title = "FAQ";
    ?>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style type="text/css">
        body {
            background: #eee;
            padding-top: 20px;
            font-family: monospace;
        }

        .header {
            border-radius: 20px 20px 0px 0px;
            padding: 10px 0px;
            background: blue;
            color: #fff;
            width: 100%;
            display: flex;
            align-content: center;
            justify-content: center;
        }

        .faq-item {
            margin-bottom: 40px;
            margin-top: 40px;
        }

        .faq-body {
            display: none;
            margin-top: 30px;
        }

        .faq-wrapper {
            width: 75%;
            margin: 0 auto;
        }

        .faq-inner {
            padding: 30px;
            background: aliceblue;
        }

        .faq-plus {
            float: right;
            font-size: 1.4em;
            line-height: 1em;
            cursor: pointer;
        }

        hr {
            background-color: #9b9b9b;
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<body>
    <?php
    $faqs = array(
        array("question" => "What services does TanahAir Offer?", "answer" => "TanahAir offers a service for creating a website design, illustration, icon set, website development, animation and digital marketing."),
        array("question" => "How does TanahAir create website content without knowing our Business plan?", "answer" => "TanahAir will schedule interviews with customers who have used our services and discuss business about the product and help solve the problem so that it becomes the best solution. "),
        array("question" => "What often will results be reported?", "answer" => "We will report each section that has been done, such as Flow, wireframe for each category, then full wireframe until it becomes a complete design and we will report the development of the website approximately every 1 week. "),
        array("question" => "Why should i choose a Design studio like TanahAir over full-service agency? ", "answer" => "Because TanahAir provides the best service to customers and provides flexibility to solve problems with our experts so that customers get satisfaction. And we provide service very quickly according to the price we offer "),
        array("question"=>" What will be delivered? And When?", "answer" => "What will be given is a design and development to become a website for that time depending on the difficulties the client gives us. However, the track record we have done to create a website design and development will take about 1 month"),
        array("question"=>" What often will results be reported? ", "answer" => "    We will report each section that has been done, such as Flow, wireframe for each category, then full wireframe until it becomes a complete design and we will report the development of the website approximately every 1 week."),



    );
    ?>

    <div class="container">
        <div class="row">
            <div class="faq-wrapper">
                <div class="header">
                    <h1>FAQs</h1>
                </div>
                <div class="faq-inner">
                    <?php foreach ($faqs as $faq) : ?>
                        <div class="faq-item">
                            <h3>
                                <?php echo $faq["question"]; ?>
                                <span class="faq-plus">&plus;</span>
                            </h3>
                            <div class="faq-body">
                                <?php echo $faq["answer"]; ?>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".faq-plus").on('click', function() {
            $(this).parent().parent().find('.faq-body').slideToggle();
        });
    </script>
</body>

</html>