# Plan de Mantenimiento de Línea de producción de bolsas de papel impresas con cuerdas retorcidas

## 1. Descripción de la Planta

La planta de producción de bolsas de papel impresas con cuerdas retorcidas cuenta con una organización física básica, donde las áreas de producción, almacenamiento y empaquetado están parcialmente definidas. Sin embargo, el flujo de trabajo presenta cuellos de botella y ciertas áreas donde la eficiencia operativa podría mejorarse, lo que ocasiona interrupciones en la línea de producción. Estas ineficiencias pueden deberse tanto a la distribución del espacio como a la disposición de los equipos.

La línea de producción está equipada con varias máquinas esenciales para el proceso de fabricación de bolsas de papel, como impresoras y máquinas de corte. Aunque se han identificado los equipos principales, falta una clasificación más detallada que indique las funciones específicas de cada máquina en el proceso productivo. La falta de esta información dificulta la implementación de un plan de mantenimiento eficiente, ya que no se tienen claros los roles críticos de cada equipo ni sus prioridades.

Actualmente, el mantenimiento se gestiona de manera reactiva. No existe un plan formal establecido para la gestión de los equipos, y las reparaciones se llevan a cabo únicamente cuando surgen fallas. Esto aumenta el riesgo de paradas inesperadas y reduce la eficiencia operativa, afectando la continuidad de la producción y el rendimiento de la planta.



## 2. Elaboración de la lista de equipos y sistemas funcionales del Área Packaging

La lista de equipos en el Área Packaging se compone de diversas máquinas y sistemas involucrados en la fabricación, impresión, corte y empaquetado de las bolsas de papel. Cada uno de estos equipos desempeña un rol crítico en el proceso productivo y debe estar sujeto a un plan de mantenimiento adecuado. 


| Código Equipo | Equipo                           | Código Sistema Funcional | Sistema Funcional                              |
|---------------|----------------------------------|--------------------------|------------------------------------------------|
|   PK-ICB      | Impresión y                      | 101PAPER-FEED            | Alimentación de bobinas de papel               |
|               | Confección de                    |                          | Sistema de Impresión flexogfrafico en línea    |
|               | Bolsas de papel                  | 101PAPER-ALN             | Sistema de alineación de bobinas               |
|---------------|----------------------------------|--------------------------|------------------------------------------------|
|    PK-CMa     | Confección                       | PK-CMa-xxx               | Sistema de Pegado inicial                      |
|               | de                               | PK-CMa-xxx               | Sistema de Pegado final                        |
|               | Manijas                          | PK-CMa-xxx               | Sistema de corte longitudinal                  |
|               |                                  | PK-CMa-xxx               | Sistema de corte perpendicular                 |
|               |                                  | PK-CMa-xxx               | Sistema de carga de bobinitas de papel         |
|               |                                  | PK-CMa-xxx               | Sistema de carga de cuerdas de papel           |
|               |                                  | PK-CMa-xxx               | Sistema de control                             |
|               |                                  | PK-CMa-xxx               | Sistema Neumático                              |
|               |                                  | PK-CMa-xxx               | Sistema de Seguridad                           |
|---------------|----------------------------------|--------------------------|------------------------------------------------|
| PK-IMP        | Máquina Impresión flexo          | PK-IMP-xxx               | Sistema eléctrico                              |
|               |                                  | PK-IMP-xxx               | Sistema mecánico                               |
|               |                                  | PK-IMP-xxx               | Sistema de control                             |
|               |                                  | PK-IMP-xxx               | Sistema de seguridad                           |
|               |                                  | PK-IMP-xxx               | Sistema de lubricación                         |
|---------------|----------------------------------|--------------------------|------------------------------------------------|
| PK-RdC        | Retorcimiento de Cuerdas         | PK-RdC-xxx               | Sistema eléctrico                              |
|               |                                  | PK-RdC-xxx               | Sistema mecánico                               |
|               |                                  | PK-RdC-xxx               | Sistema de control                             |
|               |                                  | PK-RdC-xxx               | Sistema de seguridad                           |
|               |                                  | PK-RdC-xxx               | Sistema de lubricación                         |
|---------------|----------------------------------|--------------------------|------------------------------------------------|
| PK-DCu        | Desenrrollado de Cuerdas         | PK-DCu-xxx               | Sistema eléctrico                              |
|               |                                  | PK-DCu-xxx               | Sistema mecánico                               |
|               |                                  | PK-DCu-xxx               | Sistema de control                             |
|               |                                  | PK-DCu-xxx               | Sistema de seguridad                           |
|               |                                  | PK-DCu-xxx               | Sistema de lubricación                         |
|---------------|----------------------------------|--------------------------|------------------------------------------------|
| EA-CO1        | Compresor de aire                | EA-CO1-xxx               | Sistema de compresión de aire                  |
|---------------|----------------------------------|--------------------------|------------------------------------------------|
| EA-EFV        | Sistema fotovoltaico on-grid     | EA-EFV-xxx               | Sistema inversor                               |
|---------------|----------------------------------|--------------------------|------------------------------------------------|
| EA-xxx        | Autoelevador bobina              | EA-xxx-xxx               | Sistema de empaquetado y etiquetado            |
|---------------|----------------------------------|--------------------------|------------------------------------------------|
| EA-xxx        | Autoelevador gasoil              | EA-xxx-xxx               | Sistema de empaquetado y etiquetado            |
|---------------|----------------------------------|--------------------------|------------------------------------------------|
| EA-xxx        | Autoelevador electrico           | EA-xxx-xxx               | Sistema de empaquetado y etiquetado            |
|---------------|----------------------------------|--------------------------|------------------------------------------------|


## 3. Análisis de equipos: criticidad y modelo de mantenimiento

completar

## 4. Fallo funcionales, fallos tecnicos y modos de fallos
El fallo funcional es aquel fallo que impide al equipo o al sistema analizado cumplir su funcion. Para determinar un fallo funcional, no tenemos mas que determinar la funcion que cumple y determinar el fallo como la anti funcion, como el no cumplimiento de su funcion.

El fallo tecnico es aquel que no impidiendo al equipo que cumpla su funcion, supone un funcionamiento de este. Estos fallos, aunque de menor importancia que los fallos funcionales, suponen funcionamientos anormales que pueden suponer una degradacion acelerada del equipo y acabar combirtiendose en fallos funcionales.

Podemos definir los modos de fallos como la cirscuntancias que acompañan un fallo concreto. Cada fallo funcional o tecnico puede presentar multiples modos de fallos. Es muy importante determinar todos los modos de fallos posibles, pues solo asi es posible realizar un analisis completo y exaustivo.

Podemos clasificar los fallos si queremos evitarlos u amortiguarlos.

| **Equipo** | **Sistema** | **Tipo de fallo** | **Descripción del fallo** |         **Descripción modo de fallo**        | **Clasificación** |
|------------|-------------|-------------------|---------------------------|----------------------------------------------|-------------------|
|            |             |                   |                           |                                              |                   |
|------------|-------------|-------------------|---------------------------|----------------------------------------------|-------------------|
|            |             |                   |                           |                                              |                   |
|------------|-------------|-------------------|---------------------------|----------------------------------------------|-------------------|
|            |             |                   |                           |                                              |                   |
|------------|-------------|-------------------|---------------------------|----------------------------------------------|-------------------|
|            |             |                   |                           |                                              |                   |
|------------|-------------|-------------------|---------------------------|----------------------------------------------|-------------------|
|            |             |                   |                           |                                              |                   |
|------------|-------------|-------------------|---------------------------|----------------------------------------------|-------------------|
|            |             |                   |                           |                                              |                   |
|------------|-------------|-------------------|---------------------------|----------------------------------------------|-------------------|
|            |             |                   |                           |                                              |                   |
|------------|-------------|-------------------|---------------------------|----------------------------------------------|-------------------|
|            |             |                   |                           |                                              |                   |
|------------|-------------|-------------------|---------------------------|----------------------------------------------|-------------------|
|            |             |                   |                           |                                              |                   |
|------------|-------------|-------------------|---------------------------|----------------------------------------------|-------------------|


## 5. Estudio de medidas a adoptar

En la siguiente tabla se estudian las medidas preventivas a adoptar para
evitar o minimizar los efectos de cada unos de los modos de fallo detallados en el cuadro anterior. En la primera columna se indica el modo de fallo. La segunda columna recoge las tareas de mantenimiento que se han considerado aplicables. En la siguiente tabla se detallan posibles mejoras que podrían realizarse en la instalación. La cuarta columna detalla las indicaciones que habría que realizar al personal de producción. Y la quinta y última columna, las instrucciones de mantenimiento que habría que aplicar o mejorar.

| **Modo de Fallo** | **Tipo de Medidas Preventivas** |                         **Descripción de Medidas preventivas**                         | 
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|
|                   |                                 |                                                                                        |
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|
|                   |                                 |                                                                                        |
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|
|                   |                                 |                                                                                        |
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|
|                   |                                 |                                                                                        |
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|
|                   |                                 |                                                                                        |
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|
|                   |                                 |                                                                                        |
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|
|                   |                                 |                                                                                        |
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|
|                   |                                 |                                                                                        |
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|
|                   |                                 |                                                                                        |
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|
|                   |                                 |                                                                                        |
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|
|                   |                                 |                                                                                        |
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|
|                   |                                 |                                                                                        |
|-------------------|---------------------------------|----------------------------------------------------------------------------------------|



## 6. Plan de Mantenimiento 
El Plan de Mantenimiento desarrollado para la maquina de bolsas a partir del análisis anterior sería el siguiente:
Tareas a realizar a diario:
- Tarea 1
- Tarea 2
- Tarea 3

Tareas a realizar mensualmente:
- Tarea 1
- Tarea 2
- Tarea 3

Tareas a realizar anualmente:
- Tarea 1
- Tarea 2
- Tarea 3
