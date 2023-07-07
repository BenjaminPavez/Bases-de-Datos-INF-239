import pyodbc
import pandas as pd
import time


#Para que se muestre todo el contenido de las tablas
pd.options.display.max_rows = 999

#Funciones
'''
La funcion configura la base de datos en SQL Server y crea las tablas repositorio_musica, reproduccion y lista_favoritos, insertandole los datos correspondientes
    Parametros:
        server (str): String que contiene el nombre del servidor a conectarse
        database (str): String que contiene el nombre de la base de datos
        username (str): String que contiene el nombre del usuario que accedera a la base de datos
        password (str): String que contiene la contrasena del usuario
    Retorno:
        No retorna nada
'''
def Configuration(server, database, username, password):

    #Conexion a Base de Datos
    cnxn = pyodbc.connect('DRIVER={ODBC Driver 17 for SQL Server};SERVER='+server+';DATABASE='+database+';UID='+username+';PWD='+ password)
    cursor = cnxn.cursor()

    if cursor.tables(table='repositorio_musica', tableType='TABLE').fetchone() and cursor.tables(table='reproduccion', tableType='TABLE').fetchone() and cursor.tables(table='lista_favoritos', tableType='TABLE').fetchone():
        print("Ya se crearon las tablas")
        Menu(cnxn)
    else:
        #Se crea la tabla repositorio_musica
        cursor.execute('''
                        CREATE TABLE repositorio_musica (
                            id INT NOT NULL PRIMARY KEY,
                            position INT,
                            artist_name TEXT,
                            song_name TEXT,
                            days INT,
                            top_10 INT,
                            peak_position INT,
                            peak_position_time TEXT,
                            peak_streams INT,
                            total_streams INT
                            )
                        ''')
        

        #Se crea la tabla reproduccion
        cursor.execute('''
                        CREATE TABLE reproduccion (
                            id INT NOT NULL PRIMARY KEY,
                            song_name TEXT,
                            artist_name TEXT,
                            fecha_reproduccion DATE,
                            cant_reproducciones INT,
                            favorito BIT
                            )
                        ''')


        #Se crea la tabla lista_favoritos
        cursor.execute('''
                        CREATE TABLE lista_favoritos (
                            id INT NOT NULL PRIMARY KEY,
                            song_name TEXT,
                            artist_name TEXT,
                            fecha_agregada DATE
                            )
                        ''')
        

        nombre_archivo = "song.csv"
        with open(nombre_archivo, "r", encoding="utf8") as archivo:
            # Omitir el encabezado
            next(archivo, None)
            prim_key = 1
            for linea in archivo:
                position,artist_name,song_name,days,top_10,peak_position,peak_position_time,peak_streams,total_streams = linea.split(";")

                position = int(position)
                artist_name = str(artist_name)
                song_name = str(song_name)
                days = int(days)
                top_10 = int(top_10)
                peak_position = int(peak_position)
                peak_position_time = str(peak_position_time)
                peak_streams = int(peak_streams)
                total_streams = int(total_streams)

                Insertar = "INSERT INTO repositorio_musica(id,position,artist_name,song_name,days,top_10,peak_position,peak_position_time,peak_streams,total_streams) VALUES(?,?,?,?,?,?,?,?,?,?);"
                cursor.execute(Insertar, (prim_key, position, artist_name, song_name, days, top_10, peak_position, peak_position_time, peak_streams, total_streams))
                
                #Clave primaria incrementable
                prim_key += 1
        
        cnxn.commit()
        Menu(cnxn)



'''
La funcion muestra todas las canciones que actualmente estan en la tabla reproduccion, permitiendo ordenar por fecha o cantidad de veces reproducida, con esto variable
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def MostrarReproduccion(cnxn):
    print("1) Ordenar por Fecha de reproduccion")
    print("\n")
    print("2) Ordenar por Cantidad de reproducciones ")
    print("\n")
    op = int(input("Seleccione una opcion: "))
    if op == 1:
        cursor1 = cnxn.cursor()
        query1 = "SELECT *FROM reproduccion ORDER BY fecha_reproduccion;"
        cursor1.execute(query1)
        data1 = []
        for id, song_name, artist_name, fecha_reproduccion, cant_reproducciones, favorito in cursor1:
            datalin1 = [id, song_name, artist_name, fecha_reproduccion, cant_reproducciones, favorito]
            data1.append(datalin1)

        df1 = pd.DataFrame(data1, columns = [ ' Id ',' Song_name ',' Artist_name ',' Fecha_reproduccion ',' Cant_reproducciones ',' Favorito '])
        if df1.empty:
            print("\n")
            print("-----------------------------------------------------------------------------------------------------------")
            print("--------------------------------------------La tabla esta vacia--------------------------------------------")
            print("-----------------------------------------------------------------------------------------------------------")
            print("\n")
        else:
            print("\n")
            print("-----------------------------------------------------------------------------------------------------------")
            print(df1)
            print("-----------------------------------------------------------------------------------------------------------")
            print("\n")
    elif op == 2:
        cursor1 = cnxn.cursor()
        query1 = "SELECT *FROM reproduccion ORDER BY cant_reproducciones;"
        cursor1.execute(query1)
        data1 = []
        for id, song_name, artist_name, fecha_reproduccion, cant_reproducciones, favorito in cursor1:
            datalin1 = [id, song_name, artist_name, fecha_reproduccion, cant_reproducciones, favorito]
            data1.append(datalin1)

        df1 = pd.DataFrame(data1, columns = [ ' Id ',' Song_name ',' Artist_name ',' Fecha_reproduccion ',' Cant_reproducciones ',' Favorito '])
        if df1.empty:
            print("\n")
            print("-----------------------------------------------------------------------------------------------------------")
            print("--------------------------------------------La tabla esta vacia--------------------------------------------")
            print("-----------------------------------------------------------------------------------------------------------")
            print("\n")
        else:
            print("\n")
            print("-----------------------------------------------------------------------------------------------------------")
            print(df1)
            print("-----------------------------------------------------------------------------------------------------------")
            print("\n")
    else:
        print("Favor seleccione una opcion valida \n")
        
        




'''
La funcion muestra las canciones favoritas del usuario hasta el momento en tabla lista_favoritos
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def CancionesFavoritas(cnxn):
    cursor2 = cnxn.cursor()
    query2 = "SELECT *FROM lista_favoritos ORDER BY fecha_agregada;"
    cursor2.execute(query2)
    data2 = []
    for id, song_name, artist_name, fecha_agregada in cursor2:
        datalin2 = [id, song_name, artist_name, fecha_agregada]
        data2.append(datalin2)

    df2 = pd.DataFrame(data2, columns = [ ' Id ',' Song_name ',' Artist_name ',' Fecha_agregada '])
    if df2.empty:
        print("\n")
        print("-----------------------------------------------------------------------------------------------------------")
        print("--------------------------------------------La tabla esta vacia--------------------------------------------")
        print("-----------------------------------------------------------------------------------------------------------")
        print("\n")
    else:
        print("\n")
        print("-----------------------------------------------------------------------------------------------------------")
        print(df2)
        print("-----------------------------------------------------------------------------------------------------------")
        print("\n")




'''
La funcion hace favorita una cancion, aniadiendola a la tabla lista_favoritos
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def GuardarCancion(cnxn):
    cursor3 = cnxn.cursor()
    song3 = str(input("- Ingresa el nombre de la cancion que deseas agregar: "))
    query31 = "SELECT id, song_name, artist_name FROM repositorio_musica WHERE CONVERT(VARCHAR, song_name) = (?);"
    selsongs = []
    cursor3.execute(query31,song3)
    for id, song_name, artist_name in cursor3:
        obj = [id, song_name, artist_name]
        selsongs.append(obj)
    df3 = pd.DataFrame(selsongs, columns = [ ' Id ',' Song_name ',' Artist_name '])
    if len(selsongs) > 1:
        print("\n")
        print("Hay",len(selsongs),"canciones con el mismo nombre")
        print("\n")
        print("---------------------------------------------------------------------------------------------------------")
        print(df3)
        print("---------------------------------------------------------------------------------------------------------")
        print("\n")
        num = int(input("Ingresa el Id de la cancion: "))
        print("\n")
        token = 0
        for elem in selsongs:
            id, song_name, artist_name = elem
            if int(id) == num:
                token =1
                subquery = "SELECT id, song_name, artist_name, fecha_agregada FROM lista_favoritos WHERE id = (?);"
                cursor3.execute(subquery,num)
                if cursor3.fetchone():
                    print("No puedes agregar esta cancion, ya fue agregada anteriormente:  \n")
                    subquery2 = "SELECT id, song_name, artist_name, fecha_agregada FROM lista_favoritos WHERE id = (?);"
                    cursor3.execute(subquery2,num)
                    for id,song_name, artist_name, fecha in cursor3:
                        print("---------------------------------------------------------------------------------------")
                        print(id," | ",song_name," | ",artist_name," | ",fecha)
                        print("---------------------------------------------------------------------------------------")
                        print("\n")
                else:
                    try:
                        year = str(input("Ingrese el año: "))
                        print("\n")
                        month = str(input("Ingrese el mes: "))
                        print("\n")
                        if int(month) in range(1,13):
                            day = str(input("Ingrese el dia: "))
                            print("\n")
                            if int(day) in range(1,32):
                                fecha_actual = year+"-"+month+"-"+day
                                query32 = "INSERT INTO lista_favoritos(id, song_name, artist_name, fecha_agregada) VALUES(?,?,?,?);"
                                cursor3.execute(query32,id,song_name, artist_name, fecha_actual)
                                cnxn.commit()
                                print("Se agrego correctamente la cancion \n")
                                print("---------------------------------------------------------------------------------------")
                                print(id," | ",song_name," | ",artist_name," | ",fecha_actual)
                                print("---------------------------------------------------------------------------------------")
                                query33 = "UPDATE reproduccion SET favorito = (?)  WHERE id = (?)"
                                cursor3.execute(query33, 1, id)
                                cnxn.commit()
                                print("\n")
                            else:
                                print("Dia Incorrecto, Favor ingresar datos correctos")
                        else:
                            print("Mes Incorrecto, Favor ingresar datos correctos")
                    except:
                        print("No se agrego correctamente la cancion")
        if token == 0:
            print("Favor selecciona un numero Id correcto \n")
    elif len(selsongs) == 1:
        try:
            year = str(input("Ingrese el año: "))
            print("\n")
            month = str(input("Ingrese el mes: "))
            print("\n")
            if int(month) in range(1,13):
                day = str(input("Ingrese el dia: "))
                print("\n")
                if int(day) in range(1,32):
                    fecha_actual = year+"-"+month+"-"+day
                    query32 = "INSERT INTO lista_favoritos(id, song_name, artist_name, fecha_agregada) VALUES(?,?,?,?);"
                    cursor3.execute(query32,selsongs[0][0],selsongs[0][1], selsongs[0][2], fecha_actual)
                    cnxn.commit()
                    print("Se agrego correctamente la cancion \n")
                    print("---------------------------------------------------------------------------------------")
                    print(id," | ",song_name," | ",artist_name," | ",fecha_actual)
                    print("---------------------------------------------------------------------------------------")
                    query33 = "UPDATE reproduccion SET favorito = (?)  WHERE id = (?)"
                    cursor3.execute(query33, 1, id)
                    cnxn.commit()
                    print("\n")
                else:
                    print("Dia Incorrecto, Favor ingresar datos correctos")
            else:
                print("Mes Incorrecto, Favor ingresar datos correctos")
        except:
            subquery = "SELECT id, song_name, artist_name, fecha_agregada FROM lista_favoritos WHERE id = (?);"
            cursor3.execute(subquery,selsongs[0][0])
            if cursor3.fetchone():
                print("\n")
                print("No puedes agregar esta cancion, ya fue agregada anteriormente:  \n")
                subquery22 = "SELECT id, song_name, artist_name, fecha_agregada FROM lista_favoritos WHERE id = (?);"
                cursor3.execute(subquery22,selsongs[0][0])
                for id,song_name, artist_name, fecha in cursor3:
                    print("---------------------------------------------------------------------------------------")
                    print(id," | ",song_name," | ",artist_name," | ",fecha)
                    print("---------------------------------------------------------------------------------------")
                    print("\n")
            else:
                print("No se agrego correctamente la cancion")
    else:
        print("\n")
        print("La cancion no existe \n")
        



'''
La funcion sacar de favoritas a una cancion de la tabla lista_favoritos
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def EliminarCancion(cnxn):
    cursor4 = cnxn.cursor()
    song4 = str(input("- Ingresa el nombre de la cancion que deseas eliminar: "))
    query31 = "SELECT *FROM lista_favoritos WHERE CONVERT(VARCHAR, song_name) = (?);"
    selsongs = []
    cursor4.execute(query31,song4)
    for id, song_name, artist_name, fecha_agregada in cursor4:
        obj = [id, song_name, artist_name, fecha_agregada]
        selsongs.append(obj)
    df3 = pd.DataFrame(selsongs, columns = [ ' Id ',' Song_name ',' Artist_name ',' Fecha_agregada '])
    if len(selsongs) > 1:
        print("\n")
        print("Hay",len(selsongs),"canciones con el mismo nombre")
        print("\n")
        print("---------------------------------------------------------------------------------------------------------")
        print(df3)
        print("---------------------------------------------------------------------------------------------------------")
        print("\n")
        num = int(input("Ingresa el Id de la cancion: "))
        print("\n")
        token = 0
        for elem in selsongs:
            id, song_name, artist_name, fecha_agregada = elem
            if int(id) == num:
                token = 1
                subquery = "DELETE FROM lista_favoritos WHERE id = (?);"
                cursor4.execute(subquery,num)
                cnxn.commit()
                print("Se elimino correctamente la cancion \n")
                print("---------------------------------------------------------------------------------------")
                print(id," | ",song_name," | ",artist_name," | ",fecha_agregada)
                print("---------------------------------------------------------------------------------------")
                query33 = "UPDATE reproduccion SET favorito = (?)  WHERE id = (?)"
                cursor4.execute(query33, 0, id)
                cnxn.commit()
                print("\n")
        if token == 0:
            print("Favor selecciona un numero Id correcto \n")   
    elif len(selsongs) == 1:
        subquery = "DELETE FROM lista_favoritos WHERE id = (?);"
        cursor4.execute(subquery,obj[0])
        cnxn.commit()
        print("Se elimino correctamente la cancion \n")
        print("---------------------------------------------------------------------------------------")
        print(obj[0]," | ",obj[1]," | ",obj[2]," | ",obj[3])
        print("---------------------------------------------------------------------------------------")
        query33 = "UPDATE reproduccion SET favorito = (?)  WHERE id = (?)"
        cursor4.execute(query33, 0, id)
        cnxn.commit()
        print("\n")
    else:
        print(song4," no esta en tu lista de favoritos")
        print("\n")




'''
La funcion simular la reproduccion de una cancion solicitada por el usuario
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def ReproducirCancion(cnxn):
    cursor5 = cnxn.cursor()
    song5 = str(input("- Ingresa el nombre de la cancion que deseas escuchar: "))
    query5 = "SELECT id, song_name, artist_name FROM repositorio_musica WHERE CONVERT(VARCHAR, song_name) = (?);"
    selsongs = []
    cursor5.execute(query5,song5)
    for id, song_name, artist_name in cursor5:
        obj = [id, song_name, artist_name]
        selsongs.append(obj)
    df3 = pd.DataFrame(selsongs, columns = [ ' Id ',' Song_name ',' Artist_name '])
    if len(selsongs) > 1:
        print("\n")
        print("Hay",len(selsongs),"canciones con el mismo nombre")
        print("\n")
        print("---------------------------------------------------------------------------------------------------------")
        print(df3)
        print("---------------------------------------------------------------------------------------------------------")
        print("\n")
        num = int(input("Ingresa el Id de la cancion: "))
        print("\n")
        token = 0
        for elem in selsongs:
            info = []
            id, song_name, artist_name = elem
            info.append(id)
            info.append(song_name)
            info.append(artist_name)
            
            if int(id) == num:
                token = 1
                print("Estas escuchando: ",song_name,"de",artist_name)
                print("\n")
                for k in range(1,100):
                    print("=", end="")
                    time.sleep(1/2)
                print("\n")
                subquery5 = "SELECT id, song_name, artist_name FROM reproduccion WHERE id = (?);"
                cursor5.execute(subquery5, num)
                result = cursor5.fetchone()

                if result:
                    subquery51 = "SELECT * FROM reproduccion WHERE id = (?);"
                    cursor5.execute(subquery51, num)
                    row = cursor5.fetchone()
                    if row:
                        id, song_name, artist_name, fecha_reproduccion, cant_reproducciones, favorito = row
                        cant_reproducciones += 1
                        #La fecha no se modifica, puesto que se considera la primera reproduccion
                        query53 = "UPDATE reproduccion SET cant_reproducciones = (?), fecha_reproduccion = (?)  WHERE id = (?)"
                        cursor5.execute(query53, cant_reproducciones, fecha_reproduccion, id)
                        print("Se modifico en la tabla reproducciones \n")
                        cnxn.commit() 
                else:
                    year = str(input("Ingrese el año: "))
                    print("\n")
                    month = str(input("Ingrese el mes: "))
                    print("\n")
                    if int(month) in range(1,13):
                        day = str(input("Ingrese el dia: "))
                        print("\n")
                        if int(day) in range(1,32):
                            fecha_actual = year+"-"+month+"-"+day
                            query52 = "INSERT INTO reproduccion(id, song_name, artist_name, fecha_reproduccion, cant_reproducciones, favorito) VALUES(?,?,?,?,?,?);"
                            cursor5.execute(query52, info[0], info[1], info[2], fecha_actual, 1,0)
                            print("Se agrego en la tabla reproducciones \n")
                            cnxn.commit()
                        else:
                            print("Dia Incorrecto, Favor ingresar datos correctos")
                    else:
                        print("Mes Incorrecto, Favor ingresar datos correctos")
        if token == 0:
            print("Favor selecciona un numero Id correcto \n")

    elif len(selsongs) == 1:
        print("Estas escuchando: ",song_name,"de",artist_name)
        print("\n")
        for k in range(1,100):
            print("=", end="")
            time.sleep(1/2)
        print("\n")
        subquery5 = "SELECT id, song_name, artist_name FROM reproduccion WHERE id = (?);"
        cursor5.execute(subquery5, id)
        result = cursor5.fetchone()

        if result:
            subquery51 = "SELECT * FROM reproduccion WHERE id = (?);"
            cursor5.execute(subquery51, id)
            row = cursor5.fetchone()
            if row:
                id, song_name, artist_name, fecha_reproduccion, cant_reproducciones, favorito = row
                cant_reproducciones += 1
                query53 = "UPDATE reproduccion SET cant_reproducciones = (?), fecha_reproduccion = (?)  WHERE id = (?)"
                cursor5.execute(query53, cant_reproducciones, fecha_reproduccion, id)
                print("Se modifico en la tabla reproducciones \n")
                cnxn.commit() 
        else:
            year = str(input("Ingrese el año: "))
            print("\n")
            month = str(input("Ingrese el mes: "))
            print("\n")
            if int(month) in range(1,13):
                day = str(input("Ingrese el dia: "))
                print("\n")
                if int(day) in range(1,32):
                    fecha_actual = year+"-"+month+"-"+day
                    query52 = "INSERT INTO reproduccion(id, song_name, artist_name, fecha_reproduccion, cant_reproducciones, favorito) VALUES(?,?,?,?,?,?);"
                    cursor5.execute(query52, id, song_name, artist_name, fecha_actual, 1,0)
                    print("Se agrego en la tabla reproducciones \n")
                    cnxn.commit()
                else:
                    print("Dia Incorrecto, Favor ingresar datos correctos")
            else:
                print("Mes Incorrecto, Favor ingresar datos correctos")
            
    else:
        print("\n")
        print("La cancion no existe \n")

    



'''
La funcion busca una cancion en la tabla Reproduccion, dando su informacion correspondiente a la cancion seleccionada
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def BuscarCancion(cnxn):
    cursor6 = cnxn.cursor()
    song6 = str(input("- Ingresa el nombre de la cancion que deseas buscar: "))
    query6 = "SELECT *FROM reproduccion WHERE CONVERT(VARCHAR, song_name) = (?);"
    cursor6.execute(query6,song6)
    data6 = []
    for id, song_name, artist_name, fecha_reproduccion, cant_reproducciones, favorito in cursor6:
        datalin6 = [id, song_name, artist_name, fecha_reproduccion, cant_reproducciones, favorito]
        data6.append(datalin6)

    
    df6 = pd.DataFrame(data6, columns = [ ' Id ',' Song_name ',' Artist_name ',' Fecha_reproduccion ',' Cant_reproducciones ',' Favorito '])
    if df6.empty:
        print("\n")
        print("-----------------------------------------------------------------------------------------------------------")
        print("-----------------------------------------------Sin resultados----------------------------------------------")
        print("-----------------------------------------------------------------------------------------------------------")
        print("\n")
    else:
        print("\n")
        print("-----------------------------------------------------------------------------------------------------------")
        print(df6)
        print("-----------------------------------------------------------------------------------------------------------")
        print("\n")





'''
La funcion muestra todas las canciones que el usuario haya escuchado por primera vez en los ultimos n dias, siendo n la fecha en YYYY-MM-DD
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def Reproducciones(cnxn):
    cursor7 = cnxn.cursor()
    year = str(input("Ingrese el año: "))
    print("\n")
    month = str(input("Ingrese el mes: "))
    print("\n")
    if int(month) in range(1,13):
        day = str(input("Ingrese el dia: "))
        print("\n")
        if int(day) in range(1,32):
            fecha_str = year+"-"+month+"-"+day
            query7 = "SELECT id, song_name, fecha_reproduccion, cant_reproducciones FROM reproduccion WHERE DATEDIFF(day,(?),fecha_reproduccion) < 0 ORDER BY fecha_reproduccion"  #con ese <0, sabremos si la fecha esta antes o despues de la dada
            cursor7.execute(query7,fecha_str)
            data7 = []
            for id, song_name, fecha_reproduccion, cant_reproducciones in cursor7:
                dataline7= [id, song_name, fecha_reproduccion, cant_reproducciones]
                data7.append(dataline7)
            
            df7 = pd.DataFrame(data7, columns = [ ' Id ',' Song_name ','Fecha_Reproduccion', 'Cant_reproducciones'])
            if df7.empty:
                print("\n")
                print("-----------------------------------------------------------------------------------------------------------")
                print("No se encontro canciones reproducidas antes de",fecha_str)
                print("-----------------------------------------------------------------------------------------------------------")
                print("\n")
            else:
                print("\n")
                print("-----------------------------------------------------------------------------------------------------------")
                print(df7)
                print("-----------------------------------------------------------------------------------------------------------")
                print("\n")
        else:
            print("Dia Incorrecto, Favor ingresar datos correctos")
            
    else:
        print("Mes Incorrecto, Favor ingresar datos correctos")
        




'''
La funcion busca por nombre de cancion y por artista, definido por el usuario
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def BuscarNomArt(cnxn):
    cursor8 = cnxn.cursor()
    print("1) Buscar por nombre de la cancion \n")
    print("2) Buscar por nombre del artista \n")
    sel = int(input("Seleccione una opcion: "))
    if sel == 1:
        print("\n")
        song8 = str(input("-Ingrese nombre de la cancion: "))
        query8 = "SELECT song_name, artist_name FROM repositorio_musica WHERE CONVERT(VARCHAR, song_name) = (?);"
        selsongs = []
        cursor8.execute(query8,song8)
        for song_name, artist_name in cursor8:
            obj = [song_name, artist_name]
            selsongs.append(obj)
        df8 = pd.DataFrame(selsongs, columns = [' Song_name ',' Artist_name '])
        if len(selsongs) >=1:
            print("\n")
            print("-----------------------------------------------------------------------------------------------------------")
            print(df8)
            print("-----------------------------------------------------------------------------------------------------------")
            print("\n")
        else:
            print("La cancion no existe :( \n")

        
    elif sel == 2:
        name_art = str(input("-Ingrese nombre del artista: "))
        query82 = "SELECT song_name, artist_name FROM repositorio_musica WHERE CONVERT(VARCHAR, artist_name) = (?);"
        cursor8.execute(query82,name_art)
        existe = cursor8.fetchone()
        if existe:
            data82 = []
            for song_name, artist_name in cursor8:
                dataline82 = [song_name, artist_name]
                data82.append(dataline82)
            df82 = pd.DataFrame(data82, columns = [ ' Song_name ',' Artist_name '])
            
            print("\n")
            print("-----------------------------------------------------------------------------------------------------------")
            print(df82)
            print("-----------------------------------------------------------------------------------------------------------")
        else:
            print("El artista no existe :( \n")
    else:
        print("Favor seleccionar opcion valida")




'''
La funcion muestra los top 15 artistas con mayor cantidad total de veces en que sus canciones han estado en el top 10
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def Top15(cnxn):
    cursor9 = cnxn.cursor()
    #La query agrupa todos los elementos por nombre y va sumando la cantidad de veces que ha estado en el top 10
    query9 = "SELECT TOP 15 CAST(artist_name AS VARCHAR(100)), SUM(top_10) AS total FROM repositorio_musica GROUP BY CAST(artist_name AS VARCHAR(100)) ORDER BY total DESC;"
    cursor9.execute(query9)
    data9 = []
    for song_name, artist_name in cursor9:
        dataline9 = [song_name, artist_name]
        data9.append(dataline9)
    df9 = pd.DataFrame(data9, columns = [ ' Artist_name ',' Veces_Top10 '])
    
    print("\n")
    print("-----------------------------------------------------------------------------------------------------------")
    print(df9)
    print("-----------------------------------------------------------------------------------------------------------")
    print("\n")




'''
La funcion mostrar la posicion mas alta obtenida entre todas las canciones de una artista, entre todas sus canciones
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def PeakPosition(cnxn):
    try:
        cursor10 = cnxn.cursor()
        name_art = str(input("-Ingrese nombre del artista: "))
        query101 = "SELECT TOP 1 peak_position FROM repositorio_musica WHERE CONVERT(VARCHAR, artist_name) = (?) ORDER BY peak_position DESC;"
        cursor10.execute(query101,name_art)
        for row in cursor10:
            print("\n")
            print("-----------------------------------------------------------------------------------------------------------")
            print("La posicion mas alta obtenida entre todas sus canciones de",name_art,"fue: ",row[0])
            print("-----------------------------------------------------------------------------------------------------------")
            print("\n")
    except:
        print("No existe el artista \n")




'''
La funcion muestra el promedio de los streams considerando todas las canciones de una artista
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def PromedioStreams(cnxn):
    try:
        cursor11 = cnxn.cursor()
        name_art = str(input("-Ingrese nombre del artista: "))
        query111 = "SELECT total_streams FROM repositorio_musica WHERE CONVERT(VARCHAR, artist_name) = (?);"
        streams = []
        cursor11.execute(query111,name_art)
        sumastreams = 0
        for total_streams in cursor11:
            sumastreams += total_streams[0]
            streams.append(total_streams)

        promedio = sumastreams/len(streams)
        print("\n")
        print("-----------------------------------------------------------------------------------------------------------")
        print("El artista",name_art,"en promedio tiene el siguiente numero de todos sus streams: ",promedio)
        print("-----------------------------------------------------------------------------------------------------------")
        print("\n")
    except:
        print("No existe el artista \n")





'''
La funcion crea la View y muestra por pantalla el resultado
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def CreateView(cnxn):
    try:
        cursor13 = cnxn.cursor()
        query130 = '''
                    CREATE VIEW CantidadCanciones
                    AS SELECT TOP 20 CAST(artist_name AS VARCHAR(100)) AS Artista,
                    COUNT(CAST(song_name AS VARCHAR(100))) AS NroCanciones,
                    SUM(peak_position) AS PeakPosition 
                    FROM repositorio_musica 
                    GROUP BY CAST(artist_name AS VARCHAR(100)) ORDER BY PeakPosition DESC;
                '''
        cursor13.execute(query130)
        cnxn.commit()
        query131 = "SELECT * FROM CantidadCanciones;"
        cursor13.execute(query131)
        data13 = []
        for id, song_name, fecha_reproduccion in cursor13:
            dataline7= [id, song_name, fecha_reproduccion]
            data13.append(dataline7)
        
        df13 = pd.DataFrame(data13, columns = [ ' Artista ',' NroCanciones ','PeakPosition'])
    
        print("\n")
        print("-----------------------------------------------------------------------------------------------------------")
        print(df13)
        print("-----------------------------------------------------------------------------------------------------------")
        print("\n")
    except:
        query132 = "SELECT * FROM CantidadCanciones;"
        cursor13.execute(query132)
        data13 = []
        for id, song_name, fecha_reproduccion in cursor13:
            dataline7= [id, song_name, fecha_reproduccion]
            data13.append(dataline7)
        
        df13 = pd.DataFrame(data13, columns = [ ' Artista ',' NroCanciones ','PeakPosition'])
    
        print("\n")
        print("-----------------------------------------------------------------------------------------------------------")
        print(df13)
        print("-----------------------------------------------------------------------------------------------------------")
        print("\n")



'''
La funcion ejecuta la Funcion y le pide al usuario los valores necesarios
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def CreateFuncion(cnxn):
    try:
        cursor14 = cnxn.cursor()
        #La funcion consiste un un valor aleatorio que representa la posicion de una cancion
        query14 = '''
                    CREATE FUNCTION randomnumero(@numero1 INT, @numero2 INT)
                    RETURNS INT
                    AS
                    BEGIN
                    RETURN ROUND(@numero1+ SQRT(@numero2),0);
                    END; 
                '''
        cursor14.execute(query14)
        cnxn.commit()

        num1 = int(input("Ingresa un numero: "))
        num2 = int(input("Ingresa otro numero: "))
        query131 = "SELECT dbo.randomnumero((?),(?));"
        cursor14.execute(query131,num1,num2)
        
        for nume in cursor14:
            print("Te recomentamos la cancion: ")
            cursor142 = cnxn.cursor()
            query142 = "SELECT song_name, artist_name FROM repositorio_musica WHERE position = (?);"
            cursor142.execute(query142,nume[0])
            data6 = []
            for song_name, artist_name in cursor142:
                datalin6 = [song_name, artist_name]
                data6.append(datalin6)

            df6 = pd.DataFrame(data6, columns = [' Song_name ',' Artist_name '])
            print("\n")
            print("-----------------------------------------------------------------------------------------------------------")
            print(df6)
            print("-----------------------------------------------------------------------------------------------------------")
            print("\n")
            
    
    except:
        num1 = int(input("Ingresa un numero: "))
        print("\n")
        num2 = int(input("Ingresa otro numero: "))
        print("\n")
        query132 = "SELECT dbo.randomnumero((?),(?));"
        cursor14.execute(query132,num1,num2)
        
        for nume in cursor14:
            print("Te recomentamos la cancion: ")
            cursor142 = cnxn.cursor()
            query142 = "SELECT song_name, artist_name FROM repositorio_musica WHERE position = (?);"
            cursor142.execute(query142,nume[0])
            data6 = []
            for song_name, artist_name in cursor142:
                datalin6 = [song_name, artist_name]
                data6.append(datalin6)

            df6 = pd.DataFrame(data6, columns = [' Song_name ',' Artist_name '])
            print("\n")
            print("-----------------------------------------------------------------------------------------------------------")
            print(df6)
            print("-----------------------------------------------------------------------------------------------------------")
            print("\n")



'''
La funcion contiene al menu que se le muestra al usuario
    Parametros:
        cnxn (str): String que contiene la conexion con el servidor
    Retorno:
        No retorna nada
'''
def Menu(cnxn):
    flag = True
    while flag:
        print("****************************************************************Bienvenido a Spot-Usm****************************************************************")
        print("Que desea hacer \n")
        print("1) Mostrar Reproduccion \n")
        print("2) Tus Canciones Favoritas \n")
        print("3) Guardar una cancion como favorita \n")
        print("4) Eliminar una cancion como favorita \n")
        print("5) Reproducir una cancion \n")
        print("6) Buscar una cancion \n")
        print("7) Tus Reproducciones \n")
        print("8) Buscar por nombre de cancion y por artista \n")
        print("9) Top 15 artistas con mayor cantidad total de veces en que sus canciones han estado en el top 10 \n")
        print("10) Peak position de un artista \n")
        print("11) Promedio de streams totales \n")
        print("12) Mostrar View \n")
        print("13) Ejecutar funcion SQL \n") #Ejecuta la funcion sql
        print("14) Restablecer de fabrica Spot-Usm \n") #Elimina las tablas con los datos, menos el repositorio
        seleccion = int(input("Selecciona una opcion: "))

        if seleccion == 1:
            print("\n")
            MostrarReproduccion(cnxn)
        elif seleccion == 2:
            print("\n")
            CancionesFavoritas(cnxn)
        elif seleccion == 3:
            print("\n")
            GuardarCancion(cnxn)
        elif seleccion == 4:
            print("\n")
            EliminarCancion(cnxn)
        elif seleccion == 5:
            print("\n")
            ReproducirCancion(cnxn)
        elif seleccion == 6:
            print("\n")
            BuscarCancion(cnxn)
        elif seleccion == 7:
            print("\n") 
            Reproducciones(cnxn)
        elif seleccion == 8:
            print("\n")
            BuscarNomArt(cnxn)
        elif seleccion == 9:
            print("\n")
            Top15(cnxn)
        elif seleccion == 10:
            print("\n")
            PeakPosition(cnxn)
        elif seleccion == 11:
            print("\n")
            PromedioStreams(cnxn)
        elif seleccion == 12:
            print("\n")
            CreateView(cnxn)
        elif seleccion == 13:
            print("\n")
            CreateFuncion(cnxn)
        elif seleccion == 14:
            print("--------------------------------------------------------------------------------------------------")
            print("Atencion: SE BORRARAN TODA LA INFORMACION DE LAS CANCIONES REPRODUCIDAS Y GUARDADAS COMO FAVORITAS")
            print("--------------------------------------------------------------------------------------------------")
            con = str(input("Desea continuar Y/N : "))
            #RECORDATORIO: QUITAR COMENTARIO
            if con == "Y":
                cursor12 = cnxn.cursor()
                #Elimina los datos de la tabla reproduccion
                query121 = "DELETE FROM reproduccion"
                cursor12.execute(query121)
                cnxn.commit()

                #Elimina los datos de la tabla lista_favoritos
                query122 = "DELETE FROM lista_favoritos"
                cursor12.execute(query122)
                cnxn.commit()
            else:
                Menu(cnxn)

        else:
            print("\n")
            print("Favor seleccione un numero correcto \n")
            
        con = str(input("Desea continuar en Spot-Usm Y/N: "))
        
        if con == 'Y':
            flag = True
        else:
            flag = False

Configuration('(LocalDB)\MSSQLLocalDB', 'Spot-Usm', 'users', '123456')