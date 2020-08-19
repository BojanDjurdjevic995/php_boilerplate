<?php
require_once './config/config.php';
__include('header', ['title' => 'Home']);

?>
    <div class="container mt-3 d-flex flex-wrap">
        <form action="" id="test" method="post">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" value="Bojan">
                <label>Surname</label>
                <input class="form-control" type="text" name="surname" value="Djurdjevic Baki">
                <label>Comment</label>
                <textarea class="form-control" name="comment" cols="30" rows="10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</textarea>
            </div>
            <div class="row">
                <div class="form-group mr-5">
                    <h4>Year</h4><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="year" id="2018" value="2018" checked>
                        <label class="form-check-label" for="2018">2018</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="year" id="2019" value="2019">
                        <label class="form-check-label" for="2019">2019</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="year" id="2020" value="2020">
                        <label class="form-check-label" for="2020">2020</label>
                    </div>
                </div>
                <div class="form-group mr-5">
                    <h4>Age</h4><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="age" id="19" value="19" checked>
                        <label class="form-check-label" for="19">19</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="age" id="20" value="20">
                        <label class="form-check-label" for="20">20</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="age" id="21" value="21">
                        <label class="form-check-label" for="21">21</label>
                    </div>
                </div>
                <div class="form-group mr-5">
                    <h4>Skills</h4><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skills" id="HTML" value="HTML" checked>
                        <label class="form-check-label" for="HTML">HTML</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skills" id="CSS" value="CSS">
                        <label class="form-check-label" for="CSS">CSS</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skills" id="PHP" value="PHP">
                        <label class="form-check-label" for="PHP">PHP</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skills" id="LARAVEL" value="LARAVEL">
                        <label class="form-check-label" for="LARAVEL">LARAVEL</label>
                    </div>
                </div>
                <div class="form-group mr-5">
                    <h4>Must have</h4><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="mustHave" id="money" value="money" checked>
                        <label class="form-check-label" for="money">money</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="mustHave" id="car" value="car">
                        <label class="form-check-label" for="car">car</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="mustHave" id="tractor" value="tractor">
                        <label class="form-check-label" for="tractor">tractor</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="mustHave" id="house" value="house">
                        <label class="form-check-label" for="house">house</label>
                    </div>
                </div>
                <div class="form-group">
                    <h4>Favorite name</h4><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="favoriteName" id="Bojan" value="Bojan" checked>
                        <label class="form-check-label" for="Bojan">Bojan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="favoriteName" id="Dejan" value="Dejan">
                        <label class="form-check-label" for="Dejan">Dejan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="favoriteName" id="Nenad" value="Nenad">
                        <label class="form-check-label" for="Nenad">Nenad</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="favoriteName" id="Nikola" value="Nikola">
                        <label class="form-check-label" for="Nikola">Nikola</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
<?php
__include('footer');
