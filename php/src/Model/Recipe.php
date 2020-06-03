<?php
namespace App\Model;

class Recipe
{
    /** @var string $title */
    protected $title;
    /** @var RecipeType $type */
    protected $type;
    /** @var Ingredient[] $ingredients */
    protected $ingredients;
    /** @var KitchenUtensil[] $cookware */
    protected $cookware;
    /** @var RecipeInstruction[] $instructions */
    protected $instructions;

    /**
     * @param Ingredient[] $ingredients
     * @param KitchenUtensil[] $cookware
     * @param RecipeInstruction[] $instructions
     */
    public function __construct(
        string $title,
        RecipeType $type,
        array $ingredients = [],
        array $cookware = [],
        array $instructions = []
    ) {
        $this->title = $title;
        $this->type = $type;
        $this->ingredients = $ingredients;
        $this->cookware = $cookware;
        $this->instructions = $instructions;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setType(RecipeType $type): void
    {
        $this->type = $type;
    }

    public function getType(): RecipeType
    {
        return $this->type;
    }

    public function setIngredients(Ingredient ...$ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    /** @return Ingredient[] */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function setCookware(KitchenUtensil ...$kitchenUtensil)
    {
        $this->cookware = $kitchenUtensil;
    }

    /** @return KitchenUtensil[] */
    public function getCookware(): array
    {
        return $this->cookware;
    }

    public function setInstructions(RecipeInstruction ...$instructions)
    {
        $this->instructions = $instructions;
    }

    /** @return RecipeInstruction[] */
    public function getInstructions(): array
    {
        $instructions = $this->instructions;

        usort($instructions, function(
            RecipeInstruction $current,
            RecipeInstruction $next
        ) {
            return $current->getStep() <=> $next->getStep();
        });

        return $instructions;
    }
}
