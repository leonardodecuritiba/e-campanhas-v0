<?php

namespace Database\Factories\old;

use App\Models\Commons\Expense;
use App\Models\Commons\ExpenseType;
use App\Models\HumanResources\Supplier;
use App\Models\HumanResources\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //1: ABERTO, 2: EM APROVAÇÃO, 3: APROVADO
        $status = $this->faker->randomElement([0,1,2]);
        $expense_type = ExpenseType::active()->get()->random(1)->first();
        $user = User::get()->random(2);
        $supplier = Supplier::active()->get()->random(1)->first();

        $due = $this->faker->boolean ? $this->faker->date('d/m/Y') : Carbon::now()->addDays($this->faker->randomNumber(1))->format('d/m/Y');

        return [
            'parent_id'         => NULL,
            'owner_id'          => $user[0]->id,
            'approver_id'       => $status == 3 ? $user[1]->id : NULL,
            'expense_type_id'   => $expense_type->id,
            'supplier_id'       => $supplier->id,
            'department_id'     => $this->faker->randomElement([1,2,3]),
            'reference'         => $this->faker->date('m/Y'),
            'value'             => $this->faker->randomFloat(2,100,10000),
            'observation'       => $this->faker->text(),
            'due'               => $due,
            'paid_at'     => $this->faker->boolean ? $this->faker->date('d/m/Y') : NULL,
            'status'            => $status,
        ];
    }
}
