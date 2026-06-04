<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition(): array
{
    $materiales = ['Aluminio', 'Vidrio', 'Herraje'];

    $tipo = fake()->randomElement($materiales);

    $precioCompra = fake()->randomFloat(2, 50, 2000);

    return [
        'codigo' => strtoupper($tipo[0]).'-'.fake()->unique()->numberBetween(1000, 9999),
        'nombre' => 'Producto de '.$tipo,
        'stock' => rand(5,100),
        'categoria' => $tipo,      
        'tipo_material' => $tipo,
        'proveedor' => fake()->company(),
        'precio_compra' => $precioCompra,
        'precio_venta' => $precioCompra * 1.50,
    ];
}
}