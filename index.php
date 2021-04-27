
<?php
include('header.php');
?>


        <a href='starships.php' class='nodecoration'>
        <div class="fragment borderleftyellow " >
            <div class='widthpercent50'>
                <p class='subtitle'><b>Resource</b></p>
                <p class='title'><b>Starships</b></p>
                <p class='text'>Search for starships by their name or model.</p>
                <p class='text'>Change the amount of vehicles there are.</p>
            </div>
            <div class='widthpercent50'>
                <?php 
                include('assets/svg/mfalcon.html');
                ?>
            </div>
        </div>
        </a>
        <a href='vehicles.php'  class='nodecoration'>
        
        <div class="fragment borderleftyellow ">
            <div class='widthpercent50'>
                <p class='subtitle'><b>Resource</b></p>
                <p class='title'><b>Vehicles</b></p>
                <p class='text'>Search for vehicles by their ID.</p>
                <p class='text'>Change the amount of vehicles there are.</p>
            </div>
            <div class='widthpercent50'>
                <?php 
                include('assets/svg/vehicle.html');
                ?>
            </div>
        </div>
        </a>
        
        <div class='container'>
            <div class='widthpercent50 presentation1 '>
                <p class='title'><b>What is this?</b></p>
                <p class='text'>This is a page that showcases my Star Wars API. The API is a clone of <a
                        href="https://swapi.dev/">swapi.dev</a>. It has a couple more features than the original,
                    including a data scraper for a couple resources, an amount property for each vehicle and starship, and
                    endpoints to get, increase, and decrease those amounts. <br> Some resources have not been implemented yet.</p>
                <br>
                <p class='title'><b>Can I look at the code and use it?</b></p>
                <p class='text'>If you find something useful, sure! The proyects was made as a test, so both the API and this are an open source proyect.</p><br>
                <p class='title'><b>Did you use libraries for these proyects?</b></p>
                <p class='text'> Yes. <br>
                For the API, I used the framework Slim 3.
                <br>
                For this page, I used jQuery and <a href='https://ifightcrime.github.io/bootstrap-growl/'>Bootstrap Growl</a>
                </p><br>
                <p class='title'><b>Personal links</b></p>
                <p class='text'>You can look at my <a
                        href='https://www.linkedin.com/in/cristian-metz/'>LinkedIn profile</a>, and some of my other
                    proyects on <a href='https://github.com/cetzz/'>GitHub</a> </p>
                </p>
            </div>
            <div class='widthpercent50 presentation2'>
                <p class='title'><b>What has been implemented?</b></p>

                <p class='text'><b>
                        Starships, vehicles:</b></p>
                <ul>
                    <li>Search by text function</li>
                    <li>Search by ID function</li>
                    <li>Search all, or by page</li>
                    <li>Get amount of the requested resource by ID <b class='new'>NEW!</b></li>
                    <li>Increase amount of the requested resource by ID <b class='new'>NEW!</b></li>
                    <li>Decrease amount of the requested resource by ID <b class='new'>NEW!</b></li>
                </ul>
                <p class='text'>
                    <b>Films:</b></p>
                <ul>
                    <li>Search by text function</li>
                    <li>Search by ID function</li>
                    <li>Search all, or by page</li>
                </ul>
                <p class='text'>
                    <b>General:</b></p>
                <ul>
                    <li>Wookie encoding</li>
                    <li>Creating database and tables with /init <b class='new'>NEW!</b></li>
                    <li>Scraping data from the original swapi.dev with /init <b class='new'>NEW!</b></li>
                </ul>
            </div>
        </div>



        <?php
include('footer.php');
?>