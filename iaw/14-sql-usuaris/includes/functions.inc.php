<?php

function userRow($user)
{
    return "
    <tr>
        <td>" . htmlspecialchars($user['nom']) . "</td>
        <td>" . htmlspecialchars($user['cognoms']) . "</td>
        <td>" . htmlspecialchars($user['nom_usuari']) . "</td>
        <td>" . htmlspecialchars($user['correu']) . "</td>
        <td>" . htmlspecialchars($user['data_naixement']) . "</td>
        <td>
            <a href='edit.php?id=" . htmlspecialchars($user['id']) . "' class='btn btn-default'>Editar</a> &nbsp;
            <a href='includes/delete.inc.php?id=" . htmlspecialchars($user['id']) . "' class='btn btn-default' onclick='return confirm(\"¿Seguro que quieres eliminar a este usuario?\");'>Eliminar</a>
        </td>
    </tr>";
}
