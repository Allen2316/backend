import sqlite3

#Conectar bd
class ConexionDB:
    def __init__(self):
        self.base_datos = 'C:\\Users\\Allen\\Desktop\\Desktop\\Proyectos\\backend\\Python\\Catalogo-peliculas\\catalogo-peliculas\\database\\peliculas.db'
        self.conexion = sqlite3.connect(self.base_datos)
        self.cursor = self.conexion.cursor()

    def cerrar(self):
        self.conexion.commit()
        self.conexion.close()