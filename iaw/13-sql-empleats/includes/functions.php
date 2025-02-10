<?php

function filaEmpleado($empleado)
{
    return "
    <tr>
        <td>" . htmlspecialchars($empleado['nom']) . "</td>
        <td>" . htmlspecialchars($empleado['cognom']) . "</td>
        <td>" . htmlspecialchars($empleado['email']) . "</td>
        <td>" . htmlspecialchars($empleado['data_inici']) . "</td>
        <td>
            <a href='edit.php?id=" . htmlspecialchars($empleado['id']) . "' class='btn btn-default'>Editar</a> &nbsp;
            <a href='delete.php?id=" . htmlspecialchars($empleado['id']) . "' class='btn btn-default' onclick='return confirm(\"¿Seguro que quieres eliminar a este empleado?\");'>Eliminar</a>
        </td>
    </tr>";
}

