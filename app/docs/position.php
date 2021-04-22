<?php
/**
 * @OA\Get(
 *  path="/api/v1/positions",
 *  summary="Lista de Vagas",
 *  operationId="Lista de Vagas Cadastradas",
 *  tags={"Vagas"},
 *  description="Lista de Vagas
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
 *                     @OA\Property(property="title", type="string", example="Senior Developer"),
 *                     @OA\Property(property="description", type="string", example="Vaga para Senior Developer"),
 *                     @OA\Property(property="address", type="string", example="Remoto"),
 *                     @OA\Property(property="salary", type="string", example="15000.00"),
 *                     @OA\Property(property="status", type="string", example="true"),
 *                     @OA\Property(property="company_id", type="string", example="1"),
 *                     @OA\Property(property="company_name", type="string", example="Talentify"),
 *                     @OA\Property(property="recruiter_id", type="string", example="1"),
 *                     @OA\Property(property="recruiter_name", type="string", example="Vinicius"),
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
 *  path="/api/v1/positions-open",
 *  summary="Lista Pública de Vagas Abertas",
 *  operationId="Lista Pública de Vagas Abertas",
 *  tags={"Vagas"},
 *  description="Lista Pública de Vagas Abertas
 *     Esta requisição não precisa de Token.",
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
 *                     @OA\Property(property="title", type="string", example="Senior Developer"),
 *                     @OA\Property(property="description", type="string", example="Vaga para Senior Developer"),
 *                     @OA\Property(property="address", type="string", example="Remoto"),
 *                     @OA\Property(property="salary", type="string", example="15000.00"),
 *                     @OA\Property(property="status", type="string", example="true"),
 *                     @OA\Property(property="company_id", type="string", example="1"),
 *                     @OA\Property(property="company_name", type="string", example="Talentify"),
 *                     @OA\Property(property="recruiter_id", type="string", example="1"),
 *                     @OA\Property(property="recruiter_name", type="string", example="Vinicius"),
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
 * )
 */

/**
 * @OA\Get(
 *  path="/api/v1/positions/{id}",
 *  summary="Retorna os dados de uma Vaga",
 *  operationId="OnePosition",
 *  tags={"Vagas"},
 *  description="Retorna os dados de uma Vaga
 *  O token deverá ser enviado na requisição.",
 *  security={{"bearerAuth":{}}},
 *  @OA\Parameter(
 *      name="id",
 *      in="path",
 *      description="id da vaga a ser vista",
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
 *                     @OA\Property(property="title", type="string", example="Senior Developer"),
 *                     @OA\Property(property="description", type="string", example="Vaga para Senior Developer"),
 *                     @OA\Property(property="address", type="string", example="Remoto"),
 *                     @OA\Property(property="salary", type="string", example="15000.00"),
 *                     @OA\Property(property="status", type="string", example="true"),
 *                     @OA\Property(property="company_id", type="string", example="1"),
 *                     @OA\Property(property="company_name", type="string", example="Talentify"),
 *                     @OA\Property(property="recruiter_id", type="string", example="1"),
 *                     @OA\Property(property="recruiter_name", type="string", example="Vinicius"),
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
 *     description="{'error': 'Position Not Found.'}",
 *  ),
 *  @OA\Response(
 *     response=500,
 *     description="{'error': 'ID must be a number.'}",
 *  ),
 * )
 */

/**
 * @OA\Post(
 *  path="/api/v1/positions-open-search",
 *  summary="Busca Pública de Vagas Abertas.",
 *  operationId="BuscaVagas",
 *  tags={"Vagas"},
 *  description="Busca Pública de Vagas Abertas.
 *     Esta requisição não precisa de Token.
 *  Critérios de busca aceitos: keyword, address, salary, company_name.
 *  keyword: enviando o termo pesquisado neste parâmetro a busca será feita nos campos address, title, description, salary.
 *  address: enviando o termo pesquisado neste parâmetro a busca será feita no campo address.
 *  salary: enviando o termo pesquisado neste parâmetro a busca será feita no campo salary.
 *  company_name: enviando o termo pesquisado neste parâmetro a busca será feita no campo name das Empresas que tem vagas abertas.",
 *  @OA\RequestBody(
 *      description="Data required",
 *      required=false,
 *      @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(property="keyword", type="string", example="developer"),
 *              @OA\Property(property="address", type="string", example="remoto"),
 *              @OA\Property(property="salary", type="string", example="13000"),
 *              @OA\Property(property="company_name", type="integer", example="Talentify"),
 *          )
 *      )
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
 *                     @OA\Property(property="title", type="string", example="Senior Developer"),
 *                     @OA\Property(property="description", type="string", example="Vaga para Senior Developer"),
 *                     @OA\Property(property="address", type="string", example="Remoto"),
 *                     @OA\Property(property="salary", type="string", example="15000.00"),
 *                     @OA\Property(property="status", type="string", example="true"),
 *                     @OA\Property(property="company_id", type="string", example="1"),
 *                     @OA\Property(property="company_name", type="string", example="Talentify"),
 *                     @OA\Property(property="recruiter_id", type="string", example="1"),
 *                     @OA\Property(property="recruiter_name", type="string", example="Vinicius"),
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
 * )
 */

/**
 * @OA\Post(
 *  path="/api/v1/positions",
 *  summary="Cadastrar uma nova Vaga.",
 *  operationId="CadastrarVagas",
 *  tags={"Vagas"},
 *  description="Cadastrar uma nova Vagas.
 *  O token deverá ser enviado na requisição
 *  Campos Obrigatóros: title, description, address, salary, status, company_id, recruiter_id.
 *  Para Vagas Abertas Status = 1
 *  Para Vagas Fechadas Status = 0",
 *  security={{"bearerAuth":{}}},
 *  @OA\RequestBody(
 *      description="Data required",
 *      required=true,
 *      @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(property="title", type="string", example="Senior Software Developer"),
 *              @OA\Property(property="description", type="string", example="Vaga para Senior Software Developer"),
 *              @OA\Property(property="address", type="string", example="Remoto"),
 *              @OA\Property(property="salary", type="string", example="13000"),
 *              @OA\Property(property="status", type="integer", example=1),
 *              @OA\Property(property="company_id", type="integer", example="1"),
 *              @OA\Property(property="recruiter_id", type="integer", example="1"),
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
 *       @OA\Schema(
 *         @OA\Property(
 *            property="error",
 *            type="array",
 *            @OA\Items(
 *               type="string",
 *               enum = {"The name field is required."},
 *            ),
 *            @OA\Items(
 *               type="string",
 *               enum = {"The email field is required."},
 *            ),
 *            @OA\Items(
 *               type="string",
 *               enum = {"The password field is required."},
 *            ),
 *            @OA\Items(
 *               type="string",
 *               enum = {"The company_id field is required."},
 *            ),
 *         ),
 *         ),
 *       ),
 *     ),
 *   ),
 * )
 */

/**
 * @OA\Put(
 *  path="/api/v1/positions/{id}",
 *  summary="Atualizar os dados de uma Vaga",
 *  operationId="updateVaga",
 *  tags={"Vagas"},
 *  description="Atualizar os dados de uma Vaga.
 *  Campos Obrigatóros: title, description, address, salary, status, company_id, recruiter_id.",
 *  security={{"bearerAuth":{}}},
 *  @OA\Parameter(
 *      name="id",
 *      in="path",
 *      description="ID da Vaga",
 *      required=true,
 *      @OA\Schema(type="integer")
 *  ),
 *  @OA\RequestBody(
 *      description="Data required",
 *      required=true,
 *      @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(property="title", type="string", example="Senior Software Developer"),
 *              @OA\Property(property="description", type="string", example="Vaga para Senior Software Developer"),
 *              @OA\Property(property="address", type="string", example="Remoto"),
 *              @OA\Property(property="salary", type="string", example="13000"),
 *              @OA\Property(property="status", type="integer", example=1),
 *              @OA\Property(property="company_id", type="integer", example="1"),
 *              @OA\Property(property="recruiter_id", type="integer", example="1"),
 *          )
 *      )
 *  ),
 *  @OA\Response(
 *     response=200,
 *     description="{'success': 'Position Updated.'}",
 *  ),
 *   @OA\Response(
 *     response=400,
 *     description="{'error': 'ID must be a number.}",
 *  ),
 *  @OA\Response(
 *     response=401,
 *     description="{'error': 'This Recruiter is Not Allowed to Update this Position.'}",
 *  ),
 *  @OA\Response(
 *     response=404,
 *     description="{'error': 'Position Not Found' }",
 *  ),
 *  @OA\Response(
 *     response=500,
 *     description="{'error': 'Position Not Updated' }",
 *  ),
 * )
 */

/**
 * @OA\Delete(
 *  path="/api/v1/positions/{id}",
 *  summary="Deletar uma Vaga",
 *  operationId="deletePayableAccount",
 *  tags={"Vagas"},
 *  description="Deletar uma Vaga
 *  O token deverá ser enviado na requisição
 *     Um Recrutador não pode editar/excluir vagas criadas por outro.
 *  Caso o usuário tente excluir uma vaga criada por outro receberá mensagem de erro e a vaga não será exccluída.",
 *  security={{"bearerAuth":{}}},
 *  @OA\Parameter(
 *      name="id",
 *      in="path",
 *      description="ID da Vaga",
 *      required=true,
 *      @OA\Schema(type="integer")
 *  ),
 *  @OA\Response(
 *     response=200,
 *     description="{'sucesso': 'Position Deleted.'}",
 *  ),
 *   @OA\Response(
 *     response=400,
 *     description="{'error': 'ID must be a number.}",
 *  ),
 *  @OA\Response(
 *     response=401,
 *     description="{'error': 'This Recruiter is Not Allowed to Delete this Position.'}",
 *  ),
 *  @OA\Response(
 *     response=404,
 *     description="{'error': 'Position Not Found' }",
 *  ),
 *  @OA\Response(
 *     response=500,
 *     description="{'error': 'Position Not Deleted' }",
 *  ),
 * )
 */

