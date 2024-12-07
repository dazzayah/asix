#!/bin/bash

# Para filtrar por campos, he decidido usar awk, aunque también se puede hacer con cut
USERS=$(cat /etc/passwd | awk -F ":" '{ print $1}') 

# Comprobamos que la string del primer parámetro no está vacía.
if [[ -z "$1" ]]; then
    echo "Error: Debes proporcionar el nombre de usuario como parámetro."
    echo "Uso: $0 <nombre_de_usuario>"
    exit 1 # En caso de estarlo, mostraremos como se usa y saldremos, ya que no queremos operar con valores vacíos.
fi

# Comenzamos con un condicional que mediante un grep silencioso (-q) comprueba que el valor introducido existe en la variable
# que almacenamos al principio, lo que nos indicará que el usuario existe en /etc/passwd.

if echo "$USERS" | grep -q "^$1"; then
    echo "Coincidencia encontrada: "

    echo -n "Nombre de usuario: " 
    cat /etc/passwd | grep "$1" | awk -F ":" '{ print $1}' # Filtramos por campos, el $1 indica que es la primera posición antes del separador (-F ":"), el nombre.
    
    echo -n "Identificador UID: "
    cat /etc/passwd | grep "$1" | awk -F ":" '{ print $3}' # La tercera posición contiene el UID.
    
    echo -n "Grupo: "
    cat /etc/passwd | grep "$1" | awk -F ":" '{ print $5}' # La quinta posición contiene el grupo al que pertenece el usuario ($1).
else
    echo "El usuario $1 no está registrado en el sistema. ¿Quieres darlo de alta?" # Segunda parte del script, utilizaremos useradd para esto.
    select sn in "Si" "No"; do # Select ofrecerá dos opciones, si y no, y mediante case hará una u otra cosa en función de la elección del usuario.
        case $sn in
            Si ) 
            
                echo -n "Creando usuario $1 " 

                # Permíteme la animación de carga cutrona...
                echo -n "." 
                sleep 0.8
                echo -n "." 
                sleep 0.8
                echo -n "." 
                sleep 0.8
                echo ""

                # Inicio de las validaciones (control de errores)
                # Si el comando getent devuelve 0 como stderr significa que se ha ejecutado bien.

                read -p "Grupo: " group
                if ! getent group "$group" > /dev/null; then # En este caso queremos invertirlo (para comprobar que NO existe).
                    echo "Error: El grupo $group no existe."
                    exit 1
                fi

                read -p "UID: " uid
                if getent passwd "$uid" > /dev/null; then
                    echo "Error: El UID $uid ya está en uso."
                    exit 1
                fi

                if sudo useradd -m -g "$group" -u "$uid" -p "" "$1"; then # Y si pasa las comprobaciones, finalmente ejecutaremos el comando con los valores almacenados.
                    echo "Usuario $1 creado correctamente." # Si no surge ningún problema, se mostrará este mensaje por pantalla.
                else
                    echo "Error: No se pudo crear el usuario $1." # En caso de encontrarse un error, se mostrará este y saldremos con exit 1, lo cual indica error.
                    exit 1
                fi
                break;;        

            No ) echo "No se ha realizado ningún cambio."; exit 0;;
        esac
    done
fi