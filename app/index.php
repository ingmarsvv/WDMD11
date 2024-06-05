<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex flex-col w-11/12 max-w-2xl sm:mx-3 mx-auto mt-10">
        <form action="index.php" method="POST">
            <div class="flex flex-col">
                <div class="flex flex-col sm:flex-row sm:gap-3 mb-10">
                    <div class="basis-1/2">                     
                        <label for="pname"><p>Partijas nosaukums</p></label>                      
                        <input class="border border-black rounded w-full" type="text" name="pname">                      
                    </div>
                    <div class="basis-1/2">
                        <label for="candidates"><p>Kandidātu skaits<p></label>                    
                        <input class="border border-black rounded w-full" type="text" name="candidates">       
                    </div>
                </div>
                <div class="mb-10">
                        <input class="border border-black rounded w-full hover:bg-orange-300 cursor-pointer" type="submit" name="submit" value="Click to submit">     
                </div>   
            </div>         
        </form>    
    </div>
    <?php
    echo "--------------------------------------------------------------------------------------------------";
    $candidateCount = !empty($_POST["candidates"]) ? $_POST["candidates"] : "" ;
    $party = !empty($_POST["pname"]) ? $_POST["pname"] : "";
    if(!empty($party) && is_numeric($candidateCount) && $candidateCount > 0){ ?>
        <div class="flex flex-col w-11/12 max-w-2xl sm:mx-3 mx-auto mt-10">
            <div class="text-2xl font-bold"> 
                Partija <?= $party ?> 
            </div> 
            <div>
                <form action="index.php" method="POST">
            <?php
            for($i = 0; $i < $candidateCount; $i++ ){ ?>
                <p><?= $i + 1 ?>. Kandidāta dati</p>
                <div class="flex flex-col sm:flex-row sm:gap-3 mb-10">
                    <div>                     
                        <label for="firstname">Vārds</label>                      
                        <input style="border: 1px black solid" type="text" name="candidates[<?= $i ?>][firstname]">                      
                    </div>
                    <div>
                        <label for="lastname">Uzvārds</label>                    
                        <input style="border: 1px black solid"  type="text" name="candidates[<?= $i ?>][lastname]">       
                    </div>
                    <div>
                        <label for="par">Par</label>
                        <input type="radio" name="candidates[<?= $i ?>][vote]" value="par">
                        <label for="pret">Pret</label>
                        <input type="radio" name="candidates[<?= $i ?>][vote]" value="pret">
                        <label for="atturos">Atturos</label>
                        <input type="radio" name="candidates[<?= $i ?>][vote]" value="atturos">
                    </div>
                </div>       
        <?php } ?>
                    <div>
                        <input class="border border-black rounded hover:bg-orange-300 cursor-pointer" type="submit" name="submit2" value="Click to submit">     
                    </div>
                    <br>
                </form>
            </div>
        </div>
    <?php } ?>
    <pre> <?php print_r($_POST); ?> </pre> <br>
    <table class="table-fixed text-2xl mb-72 ml-8">
    <?php
        if(isset($_POST["submit2"])){
            $candidates = !empty($_POST["candidates"]) ? $_POST["candidates"] : [];
            function compare($array1, $array2){
                return strcmp($array1['lastname'], $array2['lastname']);
            }
            usort($candidates, "compare");
            foreach($candidates as $candidate){ ?>
                <tr>
                    <td class="border border-slate-300 px-6" ><?= $candidate['firstname'] ?></td>
                    <td class="border border-slate-300 px-6" ><?= $candidate['lastname'] ?></td>
                    <td class="border border-slate-300 px-6" ><?= $candidate['vote'] ?></td>
                <?php } ?>
                </tr>
            <?php ?>
    </table>           
    <?php } ?>
</body>
</html>
