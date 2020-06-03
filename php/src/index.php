<?php

namespace App;

require(__DIR__ . "/../vendor/autoload.php");

use App\Model\Recipe;
use App\Model\RecipeType;
use App\Model\Ingredient;
use App\Model\KitchenUtensil;
use App\Model\MeasurementUnit;
use App\Model\RecipeInstruction;

function printRecipe(Recipe $recipe)
{
    echo $recipe->getTitle() . PHP_EOL;
    echo "========================" . PHP_EOL;

    echo "  Ingredients:" . PHP_EOL;

    foreach ($recipe->getIngredients() as $ingrident) {
        echo "    ";
        echo "- $ingrident" . PHP_EOL;
    }

    if (count($recipe->getCookware()) > 0) {
        echo "  Cookware:" . PHP_EOL;

        foreach ($recipe->getCookware() as $kitchenUtensil) {
            echo "    ";
            echo "- {$kitchenUtensil->getName()}" . PHP_EOL;
        }
    }

    echo "  Instructions:" . PHP_EOL;
    foreach ($recipe->getInstructions() as $instruction) {
        echo "    ";
        echo "- {$instruction->getStep()} {$instruction->getDescription()}" . PHP_EOL;
    }
}

$gram = new MeasurementUnit("Gram", "g");
$milliliter = new MeasurementUnit("Milliliter", "ml");
/**
 * @todo Add support to plural representation
 */
$cups = new MeasurementUnit("Cup(s)", " cup(s)");
$teaspoon = new MeasurementUnit("Teaspoon(s)", " teaspoon(s)");

$bakingType = new RecipeType("Baking");
$cookingType = new RecipeType("Cooking");

$noKneadBread = new Recipe("No Knead Bread", $bakingType);

$noKneadBread->setIngredients(
    new Ingredient("Bread Flour", $gram, 400),
    new Ingredient("Instant Yeast", $gram, 10),
    new Ingredient("Water", $milliliter, 260),
    new Ingredient("Salt", $gram, 260),
);

$noKneadBread->setCookware(
    new KitchenUtensil("Dutch Oven"),
    new KitchenUtensil("Large Mixing Bowl"),
    new KitchenUtensil("Towel"),
    new KitchenUtensil("Oven"),
    new KitchenUtensil("Cooling Rack"),
);

$noKneadBread->setInstructions(
    new RecipeInstruction(10, "Let bread cool on rack until room temp"),
    new RecipeInstruction(9, "Remove lid, lower the heat to 450 degrees F for 30 minutes (until brown)"),
    new RecipeInstruction(8, "Bake the dutch oven for 20 minutes"),
    new RecipeInstruction(7, "Place bread dough in dutch oven and close the lid"),
    new RecipeInstruction(6, "Take out dutch oven and remove lid"),
    new RecipeInstruction(5, "Pre-heat oven at 500 degrees F"),
    new RecipeInstruction(4, "Place dutch oven in oven"),
    new RecipeInstruction(3, "Cover with damp towel and set aside for 24 hours"),
    new RecipeInstruction(2, "Mix all ingredients until there is no dry flour"),
    new RecipeInstruction(1, "Put all ingredients in mixing bowl"),
);

$beefGravy = new Recipe("Beef gravy", $cookingType);

$beefGravy->setIngredients(
    new Ingredient("Butter", $cups, 2),
    new Ingredient("All purpose flour", $cups, 2),
    new Ingredient("Beef broth", $cups, 4),
    new Ingredient("Salt and Pepper to taste", null),
);

$beefGravy->setCookware(
    new KitchenUtensil("Sauce pan"),
    new KitchenUtensil("Spatula"),
);

$beefGravy->setInstructions(
    new RecipeInstruction(1, "Melt butter in saucepan"),
    new RecipeInstruction(2, "Add flour and mix together to form a paste"),
    new RecipeInstruction(3, "Once desired color achieved, add in beef broth"),
    new RecipeInstruction(4, "Simmer until thickness is achieved"),
    new RecipeInstruction(5, "Season with salt and pepper to taste"),
);

$cheeseBread = new Recipe("Brazilian Cheese Bread", $bakingType);

$cheeseBread->setIngredients(
    new Ingredient("Olive oil or butter", $cups, 2),
    new Ingredient("Water", $cups, 2),
    new Ingredient("Milk or soy milk", $cups, 2),
    new Ingredient("Salt", $teaspoon, 1),
    new Ingredient("Tapioca flour", $cups, 2),
    new Ingredient("Minced garlic", $teaspoon, 2),
    new Ingredient("Freshly grated Parmesan cheese", $cups, 4),
    new Ingredient("Beaten eggs", null, 2),
);

$cheeseBread->setInstructions(
    new RecipeInstruction(1, "Preheat oven to 375 degrees F (190 degrees C)."),
    new RecipeInstruction(2, <<<EOT
    Pour olive oil, water, milk, and salt into a large saucepan, and place over high heat.
    \tWhen the mixture comes to a boil, remove from heat immediately, and stir in tapioca
    \tflour and garlic until smooth. Set aside to rest for 10 to 15 minutes.
    EOT),
    new RecipeInstruction(3, <<<EOT
    Stir the cheese and egg into the tapioca mixture until well combined, the mixture will
    \tbe chunky like cottage cheese. Drop rounded, 1/4 cup-sized balls of the mixture onto
    \tan ungreased baking sheet.
    EOT),
    new RecipeInstruction(4, "Bake in preheated oven until the tops are lightly browned, 15 to 20 minutes."),
);

printRecipe($noKneadBread);

echo PHP_EOL;

printRecipe($beefGravy);

echo PHP_EOL;

printRecipe($cheeseBread);
