<?php
// source: template/homeTemplate.latte

use Latte\Runtime as LR;

class Templatedf6c71f3c7 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>District CZ</title>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">District</h1>
            <p class="lead">Czech republic</p>
            <hr class="my-4">
            <p>Get information about the district</p>
        </div>
        <form>
            <div class="form-group">
                <label for="region">Select region</label>
                <select id="region" class="form-control" onchange="loadDistrict()">
                    <option value="null">Select ...</option>
<?php
		$iterations = 0;
		foreach ($kraje as $item) {
			?>                    <option value=<?php echo LR\Filters::escapeHtmlAttrUnquoted($item["id"]) /* line 22 */ ?>><?php
			echo LR\Filters::escapeHtmlText($item["nazev"]) /* line 22 */ ?></option>
<?php
			$iterations++;
		}
?>
                </select>
            </div>
            <div class="form-group">
                <label for="district">Select district</label>
                <select id="district" class="form-control" onchange="displayInfoDistrict()">
                    <option value="null">Select ...</option>
                </select>
            </div>
        </form>

        
        <iframe id="infoDistrict" src="https://www.statnisprava.cz/rstsp/redakce.nsf/i/kraje_okresy_obce" frameborder="0" width="800" height="800"></iframe>
        


    </div>
    
    <script type="text/javascript">
        function loadDistrict() {
            var idRegion = document.getElementById("region").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var dataArray = JSON.parse(this.responseText);
                    var x = document.getElementById("district");
                    x.innerHTML="";

                    dataArray.forEach(function(item) {
                        var option = document.createElement("option");
                        option.text = item["nazev"];
                        option.value = item["kod"]
                        x.add(option);  
                    });
                }
            };
            xmlhttp.open("GET", "src/getDistrict.php?idk=" + idRegion, true);
            xmlhttp.send();
        }

        function displayInfoDistrict(){
            var district = document.getElementById("district").value;
            document.getElementById("infoDistrict").src = "https://www.statnisprava.cz/rstsp/ciselniky.nsf/i/"+district;
        }
        
    </script>

</body>
</html><?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['item'])) trigger_error('Variable $item overwritten in foreach on line 22');
		
	}

}
