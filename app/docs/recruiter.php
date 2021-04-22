<?php
/**
 * @OA\Get(
 *  path="/api/v1/recruiters",
 *  summary="Lista de Recrutadores",
 *  operationId="Lista de Recrutadores Cadastradas",
 *  tags={"Recrutador"},
 *  description="Lista de Recrutadores
 * O token deverá ser enviado na requisição",
 *  security={{"bearerAuth":{}}},
 *  @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="name", type="string", example="Vinicius"),
 *                     @OA\Property(property="email", type="string", example="vinicius@email.com"),
 *                     @OA\Property(property="company_id", type="integer", example="1"),
 *                     @OA\Property(property="company_name", type="integer", example="Talentify"),
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="links",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="first", type="integer"),
 *                      @OA\Property(property="last", type="integer"),
 *                      @OA\Property(property="prev", type="integer"),
 *                      @OA\Property(property="next", type="integer"),
 *                  )
 *              ),
 *              @OA\Property(
 *                  property="meta",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="current_page", type="integer"),
 *                      @OA\Property(property="from", type="integer"),
 *                      @OA\Property(property="last_page", type="integer"),
 *                      @OA\Property(property="path", type="string"),
 *                      @OA\Property(property="per_page", type="integer"),
 *                      @OA\Property(property="to", type="integer"),
 *                      @OA\Property(property="total", type="integer"),
 *                  )
 *              ),
 *          )
 *     )
 *  ),
 *  @OA\Response(
 *     response=402,
 *     description="{'error': 'Token expired.}",
 *  ),
 * )
 */

/**
 * @OA\Get(
 *  path="/api/v1/recruiters/{id}",
 *  summary="Retorna os dados de um Recrutador",
 *  operationId="OneRecruiter",
 *  tags={"Recrutador"},
 *  description="Retorna os dados de um Recrutador
 *  O token deverá ser enviado na requisição.",
 *  security={{"bearerAuth":{}}},
 *  @OA\Parameter(
 *      name="id",
 *      in="path",
 *      description="id do Recrutador a ser visto",
 *      required=true,
 *      @OA\Schema(type="integer")
 *  ),
 *  @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="name", type="string", example="Vinicius"),
 *                     @OA\Property(property="email", type="string", example="vinicius@email.com"),
 *                     @OA\Property(property="company_id", type="integer", example="1"),
 *                     @OA\Property(property="company_name", type="integer", example="Talentify"),
 *                  ),
 *              ),
 *          )
 *     )
 *  ),
 *  @OA\Response(
 *     response=401,
 *     description="{'error': 'Token expired.}",
 *  ),
 *  @OA\Response(
 *     response=404,
 *     description="{'error': 'Recruiter Not Found.'}",
 *  ),
 *  @OA\Response(
 *     response=500,
 *     description="{'error': 'ID must be a number.'}",
 *  ),
 * )
 */

/**
 * @OA\Post(
 *  path="/api/v1/recruiters",
 *  summary="Cadastrar uma nova Recrutador.",
 *  operationId="CadastrarRecrutador
 * O token deverá ser enviado na requisição",
 *  tags={"Recrutador"},
 *  description="Cadastrar uma nova Recrutador.
 *  O token deverá ser enviado na requisição.
 *  Campos Obrigatóros: name, email, password, company_id.
 *  Email é campo único.
 *     De acordo com o requisito, cada recrutador pertence a uma empresa diferente. Com isso, não pode existir mais de
 *     um Recrutador na mesma Empresa, ou seja, cada Empresa só pode ter 1 Recrutador cadastrado.
 * Caso seja feita a requisição para cadastrar um novo Recrutador em uma Empresa que já tenha outro Recrutador cadastrado
 * o retorno será de erro informando que o id da empresa selecionada já está sendo usado.",
 *  security={{"bearerAuth":{}}},
 *  @OA\RequestBody(
 *      description="Data required",
 *      required=true,
 *      @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(property="name", type="string", example="Pedro Campos"),
 *              @OA\Property(property="email", type="string", example="email@email.com"),
 *              @OA\Property(property="password", type="string", example="senha"),
 *              @OA\Property(property="company_id", type="integer", example="1"),
 *          )
 *      )
 *  ),
 *  @OA\Response(
 *     response=201,
 *     description="{'success': 'Recruiter Created!'}",
 *  ),
 *  @OA\Response(
 *    response=422,
 *    description="error: O retorno será um array contendo a informação do(s) campo(s) obrigatório(s)",
 *    @OA\MediaType(
 *       mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="errors",
 *                  type="array",
 *                  @OA\Items(
 *                     @OA\Property(property="name", type="string", example="The name field is required."),
 *                     @OA\Property(property="email", type="string", example="The email field is required."),
 *                     @OA\Property(property="company_id", type="integer", example="The password field is required."),
 *                     @OA\Property(property="company_name", type="integer", example="The company id field is required."),
 *                     @OA\Property(property="email ", type="integer", example="The email has already been taken."),
 *                     @OA\Property(property="company_id ", type="integer", example="The company id has already been taken."),
 *                  ),
 *              ),
 *          )
 *       ),
 *     ),
 *   ),
 * )
 */
